<?php

use Castor\Attribute\AsContext;
use Castor\Attribute\AsOption;
use Castor\Attribute\AsTask;
use Castor\Context;

use function Castor\capture;
use function Castor\finder;
use function Castor\fingerprint;
use function Castor\fs;
use function Castor\import;
use function Castor\input;
use function Castor\io;
use function Castor\run;
use function fingerprints\composer_fingerprint;
use function fingerprints\dockerfile_fingerprint;
use function utils\import_from_git_remote;

import('./.castor');

import_from_git_remote('git@github.com:TheoD02/castor_extras.git');

#[AsContext(default: true)]
function default_context(): Context
{
    return new Context(
        data: [
            'docker' => [
                'container' => 'my-wtb-suppliers-1',
                'user' => capture('id -u'),
                'group' => capture('id -g'),
                'workdir' => '/app',
            ]
        ],
        currentDirectory: __DIR__ . '/app'
    );
}

#[AsContext]
function qa(): Context
{
    return default_context()
        ->withData([
            'docker' => [
                'workdir' => '/tools',
            ]
        ])
        ->withPath(__DIR__ . '/tools');
}

#[AsTask(description: 'Start project')]
function start(bool $force = false): void
{
    build(force: $force);
    Docker::compose(['app'])->up(detach: true, wait: true);
    //Docker::compose(['worker'])->up(detach: true, wait: false);
}

#[AsTask(description: 'Stop project')]
function stop(): void
{
    Docker::compose(['app'])->down();
    Docker::compose(['worker'])->down();
}

#[AsTask(description: 'Restart project')]
function restart(): void
{
    stop();
    start();
}

function build(bool $force = false): void
{
    fingerprint(fn() => Docker::compose(['app'])->build(noCache: true),
        fingerprint: dockerfile_fingerprint(),
        force: $force);
}

#[AsTask(description: 'Install project')]
function install(bool $force = false): void
{
    start(force: $force);
    fingerprint(callback: fn() => Composer::install(), fingerprint: composer_fingerprint(), force: $force);
}

#[AsTask(description: 'Open shell in the container (default: fish)', aliases: ['sh', 'fish'])]
function shell(
    #[AsOption(description: 'If run as root')]
    bool $root = false
): void {
    $shell = input()->getArgument('command') === 'shell' ? 'fish' : input()->getArgument('command');
    Docker::exec(cmd: $shell, user: $root ? 'root' : 'www-data');
}

#[AsTask]
function create_domain(): void
{
    $baseNamespace = 'App';
    $domainBasePath = __DIR__ . '/app/apps';
    $domainName = io()->ask('Enter the domain name');
    $domainPath = $domainBasePath . '/' . $domainName;
    $domainNamespace = $baseNamespace . '\\' . ucfirst($domainName);

    if (fs()->exists($domainPath)) {
        io()->error('Domain already exists');
        return;
    }

    fs()->mkdir([
        $domainPath . '/src',
        $domainPath . '/src/ApiResource',
        $domainPath . '/src/Controller',
        $domainPath . '/src/Entity',
        $domainPath . '/src/Repository',
        $domainPath . '/config',
        $domainPath . '/tests',
    ]);

    fs()->touch([
        $domainPath . '/config/services.yaml',
        $domainPath . '/config/routes.yaml',
        $domainPath . '/src/ApiResource/.gitkeep',
        $domainPath . '/src/Controller/.gitkeep',
        $domainPath . '/src/Entity/.gitkeep',
        $domainPath . '/src/Repository/.gitkeep',
    ]);

    // copy bundles.php from app
    fs()->copy(__DIR__ . '/app/config/bundles.php', $domainPath . '/config/bundles.php');

    $composer = json_decode(file_get_contents(__DIR__ . '/app/composer.json'), true, 512, JSON_THROW_ON_ERROR);
    $composer['autoload']['psr-4'][$domainNamespace . '\\'] = 'apps/' . $domainName . '/src';
    $composer['autoload-dev']['psr-4'][$domainNamespace . '\\Tests\\'] = 'apps/' . $domainName . '/tests';
    file_put_contents(
        __DIR__ . '/app/composer.json',
        json_encode($composer, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES)
    );

    io()->success('Domain created');
    io()->text('Please add the following service to the compose.yaml file');
    io()->newLine();
    io()->text(
        <<<YAML
    services:
        $domainName:
            build:
                context: .
                dockerfile: Dockerfile
                target: dev
            environment:
                APP_ID: "$domainName"
                SERVER_NAME: ":80"
                MERCURE_PUBLISHER_JWT_KEY: \${CADDY_MERCURE_JWT_SECRET:-!ChangeThisMercureHubJWTSecretKey!}
                MERCURE_SUBSCRIBER_JWT_KEY: \${CADDY_MERCURE_JWT_SECRET:-!ChangeThisMercureHubJWTSecretKey!}
                TRUSTED_PROXIES: \${TRUSTED_PROXIES:-127.0.0.0/8,10.0.0.0/8,172.16.0.0/12,192.168.0.0/16}
                TRUSTED_HOSTS: ^\${SERVER_NAME:-example\.com|localhost}|php$$
                # Run "composer require symfony/mercure-bundle" to install and configure the Mercure integration
                MERCURE_URL: \${CADDY_MERCURE_URL:-http://php/.well-known/mercure}
                MERCURE_PUBLIC_URL: https://\${SERVER_NAME:-localhost}/.well-known/mercure
                MERCURE_JWT_SECRET: \${CADDY_MERCURE_JWT_SECRET:-!ChangeThisMercureHubJWTSecretKey!}
            volumes:
                - ./app:/app
                - ./tools:/tools
                - ~/.ssh:/home/www-data/.ssh:ro
            labels:
                - "traefik.enable=true"
                - "traefik.http.routers.php-$domainName.rule=Host(`$domainName.web.localhost`)"
                - "traefik.http.routers.php-$domainName.tls=true"
                - "traefik.http.services.php-$domainName.loadbalancer.server.port=80"
            networks:
                - traefik
                - service
            profiles:
                - app
YAML
    );
}

#[AsTask]
function remove_domain(): void
{
    $baseNamespace = 'App';
    $domainBasePath = __DIR__ . '/app/apps';
    $domains = finder()->directories()->in($domainBasePath)->depth(0)->getIterator();
    $domainsName = [];
    foreach ($domains as $domain) {
        $domainsName[] = $domain->getFilename();
    }

    $domainName = io()->choice('Select the domain to remove', $domainsName);
    $domainNamespace = $baseNamespace . '\\' . ucfirst($domainName);

    $domainPath = $domainBasePath . '/' . $domainName;

    $composer = json_decode(file_get_contents(__DIR__ . '/app/composer.json'), true, 512, JSON_THROW_ON_ERROR);
    unset($composer['autoload']['psr-4'][$domainNamespace . '\\'], $composer['autoload-dev']['psr-4'][$domainNamespace . '\\Tests\\']);
    file_put_contents(
        __DIR__ . '/app/composer.json',
        json_encode($composer, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES)
    );


    fs()->remove($domainPath);
    io()->success("Domain $domainName removed");
    io()->note("Please remove the service from the compose.yaml file. If not changed, the service name is $domainName");
}

#[AsTask]
function import_wyzapi_sql(): void
{
    // @see https://github.com/kedarvj/mysqldumpsplitter for split one big sql file to multiple
    // sh mysqldumpsplitter.sh --source ./wyzapi.int.sql --extract ALLTABLES --compression none
    run("docker compose exec wyzapi-database mysql -u root -proot -e 'DROP DATABASE wyzapi'");
    run("docker compose exec wyzapi-database mysql -u root -proot -e 'CREATE DATABASE wyzapi'");
    $sqlFiles = finder()->files()->in('/home/theo/Downloads/wyzapidb/out')->name('*.sql')->sortByName();
    $globalStart = microtime(true);
    foreach ($sqlFiles as $file) {
        $start = microtime(true);
        io()->write("Importing $file");
        run("docker compose exec -T wyzapi-database mysql -u root -proot wyzapi < $file", timeout: 0);

        $seconds = number_format(microtime(true) - $start, 2);
        io()->writeln("<info> Done</info> in $seconds seconds");
    }

    $globalSeconds = number_format(microtime(true) - $globalStart, 2);
    io()->writeln("<info>Import done in $globalSeconds seconds</info>");
}
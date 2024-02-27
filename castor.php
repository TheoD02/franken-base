<?php

use Castor\Attribute\AsContext;
use Castor\Attribute\AsOption;
use Castor\Attribute\AsTask;
use Castor\Context;

use function Castor\capture;
use function Castor\context;
use function Castor\fingerprint;
use function Castor\fs;
use function Castor\import;
use function Castor\input;
use function Castor\io;
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
                'container' => 'franken-base-app-1',
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
    init_project();
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

function init_project(): void
{
    if (fs()->exists('./app/composer.json')) {
        return;
    }

    $ecsContent = <<<PHP
<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/tools/ecs/BaseECSConfig.php';

return BaseECSConfig::config();
PHP;

    $rectorContent = <<<PHP
<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/tools/rector/BaseRectorConfig.php';

return BaseRectorConfig::config();
PHP;

    $sfVersion = io()->choice('Which version of Symfony do you want to use?', ['5.4', '6.4', '7.*'], '6.4');
    io()->writeln('Creating Symfony project...');

    Docker::exec(cmd: "composer create-project symfony/skeleton:\"{$sfVersion}.*\" tmp");
    $dir = context()->currentDirectory;
    fs()->mirror("{$dir}/tmp", $dir);

    fs()->remove("{$dir}/tmp");

    io()->info('Setting up ECS and Rector...');
    file_put_contents("{$dir}/ecs.php", $ecsContent);
    file_put_contents("{$dir}/rector.php", $rectorContent);

    Docker::exec(cmd: 'composer require --dev symfony/debug-pack symfony/maker-bundle');
    Docker::exec(cmd: 'composer require twig-bundle');

    $front = io()->choice('Use webpack-encore or vite ?', ['webpack-encore', 'vite'], 'webpack-encore');

    if ($front === 'webpack-encore') {
        Docker::exec(cmd: 'composer require symfony/webpack-encore-bundle');
    } else {
        Docker::exec(cmd: 'composer require pentatrion/vite-bundle');
    }

    $currentDir = context()->currentDirectory;
    $envLocalContent = file_get_contents("{$currentDir}/.env.local");
    $envLocalContent = str_replace('{PROJECT_PATH}', $currentDir, $envLocalContent);
    file_put_contents("{$currentDir}/.env.local", $envLocalContent);
}

#[AsTask(name: 'db:reset', description: 'Reset the database')]
function db_reset(): void
{
    Symfony::console(cmd: 'doctrine:database:drop --force --if-exists');
    Symfony::console(cmd: 'doctrine:database:create');
    Symfony::console(cmd: 'doctrine:schema:create');
    Symfony::console(cmd: 'doctrine:fixtures:load --no-interaction');
}
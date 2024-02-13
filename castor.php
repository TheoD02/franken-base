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
                'container' => 'franken-base-app',
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
    init();
    //Docker::compose(['worker'])->up(detach: true, wait: false);
}

#[AsTask(description: 'Stop project')]
function stop(): void
{
    Docker::compose(['app', 'worker'])->down();
}

#[AsTask(description: 'Restart project')]
function restart(): void
{
    stop();
    start();
}

function build(bool $force = false): void
{
    fingerprint(
        fn() => Docker::compose(['app'])->build(noCache: true),
        fingerprint: dockerfile_fingerprint(),
        force: $force
    );
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

function init(): void
{
    if (fs()->exists('./app/composer.json')) {
        return;
    }

    io()->title('Initializing project');

    $symfonyVersion = io()->choice('Symfony version to install ?', ['5.4', '6.4', '7.0'], '6.4');

    Composer::cmd("create-project symfony/skeleton:\"$symfonyVersion.*\" tmp");

    fs()->mirror('./app/tmp', './app');
    fs()->remove('./app/tmp');

    $useWebAppReady = io()->confirm('Use webapp for Symfony project ?', true);

    if ($useWebAppReady) {
        Composer::cmd('require webapp');
    }

    if (fs()->exists('./app/compose.yaml')) {
        fs()->remove('./app/compose.yaml');
    }

    if (fs()->exists('./app/compose.override.yaml')) {
        fs()->remove('./app/compose.override.yaml');
    }

    io()->success('Project initialized');
}

#[AsTask(name: 'db:reset', description: 'Reset database')]
function db_reset(): void
{
    Symfony::console('doctrine:database:drop --force --if-exists');
    Symfony::console('doctrine:database:create');
    Symfony::console('doctrine:schema:create');
    Symfony::console('doctrine:fixtures:load --no-interaction');
}
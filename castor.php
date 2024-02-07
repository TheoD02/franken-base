<?php

use Castor\Attribute\AsContext;
use Castor\Attribute\AsTask;
use Castor\Context;

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
                'container' => 'sf-franken-app-1'
            ]
        ]
    );
}

#[AsTask(description: 'Start project')]
function start(bool $force = false): void
{
    build(force: $force);
    Docker::compose()->up(detach: true);
    init();
}

#[AsTask(description: 'Stop project')]
function stop(): void
{
    Docker::compose()->down();
}

#[AsTask(description: 'Restart project')]
function restart(): void
{
    stop();
    start();
}

function build(bool $force = false): void
{
    fingerprint(fn() => Docker::compose()->build(noCache: true), fingerprint: dockerfile_fingerprint(), force: $force);
}

#[AsTask(description: 'Install project')]
function install(bool $force = false): void
{
    start(force: $force);
    fingerprint(callback: fn() => Composer::install(), fingerprint: composer_fingerprint(), force: $force);
}

function init(): void
{
    if (fs()->exists('composer.json')) {
        return;
    }

    $symfonyVersionToInstall = io()->choice(
        'Which version of Symfony do you want to install?',
        ['7.0', '6.4', '5.4'],
        default: '6.4'
    );

    Composer::cmd("create-project symfony/skeleton:\"^$symfonyVersionToInstall\" sf");

    fs()->mirror('./sf/', './');
    fs()->remove('sf');
}

#[AsTask(description: 'Open shell in the container (default: fish)', aliases: ['sh', 'fish'])]
function shell(): void
{
    $shell = input()->getArgument('command') === 'shell' ? 'fish' : input()->getArgument('command');
    Docker::exec(cmd: $shell);
}
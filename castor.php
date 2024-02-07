<?php

use Castor\Attribute\AsContext;
use Castor\Attribute\AsTask;
use Castor\Context;

use function Castor\capture;
use function Castor\fingerprint;
use function Castor\import;
use function Castor\input;
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
                'container' => 'sf-franken-app-1',
                'user' => capture('id -u'),
                'group' => capture('id -g')
            ]
        ]
    );
}

#[AsTask(description: 'Start project')]
function start(bool $force = false): void
{
    build(force: $force);
    Docker::compose()->up(detach: true, wait: true);
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

#[AsTask(description: 'Open shell in the container (default: fish)', aliases: ['sh', 'fish'])]
function shell(): void
{
    $shell = input()->getArgument('command') === 'shell' ? 'fish' : input()->getArgument('command');
    Docker::exec(cmd: $shell);
}
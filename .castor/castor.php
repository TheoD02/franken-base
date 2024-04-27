<?php

use Castor\Attribute\AsTask;

use function Castor\context;
use function Castor\fingerprint;
use function Castor\import;
use function Castor\io;
use function Castor\notify;
use function Castor\run;
use function Castor\set_notify_title;
use function TheoD02\Castor\Docker\docker;

require_once __DIR__ . '/vendor/autoload.php';

import('composer://theod02/castor-class-task');
import('composer://theod02/castor-docker');

import(__DIR__);

//set_notify_title('Franken Base');

#[AsTask]
function start(bool $force = false): void
{
    if (docker()->utils()->isRunningInsideContainer()) {
        io()->note('[start] cannot be run inside container. Skipping.');
        return;
    }

    if (
        !fingerprint(
            callback: fn() => docker()->compose(profile: ['app'])->build(noCache: true),
            fingerprint: fgp()->php_docker(),
            force: $force,
        )
    ) {
        io()->note('Docker images are already built.');
    }

    docker()->compose(profile: ['app'])->up(detach: true, wait: true);
}

#[AsTask]
function stop(): void
{
    docker()->compose(profile: ['app'])->down();
}

#[AsTask]
function restart(): void
{
    stop();
    start();
}

#[AsTask]
function install(bool $force = false): void
{
    io()->title('Installing dependencies');
    io()->section('Composer');
    $forceVendor = $force || !is_dir(context()->workingDirectory . '/app/vendor');
    if (!fingerprint(callback: fn() => composer()->install(), fingerprint: fgp()->composer(), force: $forceVendor || $force)) {
        io()->note('Composer dependencies are already installed.');
    }

    io()->section('NPM');
    $forceNodeModules = $force || !is_dir(context()->workingDirectory . '/app/node_modules');
    if (!fingerprint(callback: fn() => npm()->install(), fingerprint: fgp()->npm(), force: $forceNodeModules || $force)) {
        io()->note('NPM dependencies are already installed.');
    }

    npm()->run('build-prod');

    notify('Dependencies installed');
}

#[AsTask(name: 'ui:dev')]
function ui_dev(): void
{
    npm()->run('dev');
}

#[AsTask]
function shell(): void
{
    $context = context()->withTty();
    docker($context)->compose()->exec(service: 'app', args: ['fish'], user: 'www-data');
}


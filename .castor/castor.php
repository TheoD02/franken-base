<?php

use Castor\Attribute\AsTask;

use function Castor\context;
use function Castor\fingerprint;
use function Castor\import;
use function Castor\io;
use function Castor\run;
use function TheoD02\Castor\Docker\docker;

require_once __DIR__ . '/vendor/autoload.php';

import('composer://theod02/castor-class-task');
import('composer://theod02/castor-docker');

import(__DIR__);

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

    if (is_dir(context()->workingDirectory . '/app/vendor') === false) {
        io()->newLine();
        io()->note('Project seem to not be installed, consider to run `castor install`');
        if (io()->confirm('Do you want to run `castor install` now')) {
            run([$_SERVER['argv'][0], 'install']);
        }
    }
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
    if (!fingerprint(callback: fn() => composer()->install(), fingerprint: fgp()->composer(), force: $force)) {
        io()->note('Composer dependencies are already installed.');
    }

    io()->section('NPM');
    if (!fingerprint(callback: fn() => npm()->install(), fingerprint: fgp()->npm(), force: $force)) {
        io()->note('NPM dependencies are already installed.');
    }
}

#[AsTask]
function shell(): void
{
    $context = context()->withTty();
    docker($context)->compose()->exec(service: 'app', args: ['fish'], user: 'www-data');
}

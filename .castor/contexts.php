<?php

use Castor\Attribute\AsContext;
use Castor\Context;
use Castor\Utils\Docker\CastorDockerContext;

#[AsContext(name: 'app', default: true)]
function default_context(): Context
{
    $root = dirname(__DIR__);
    $castorPath = "$root/.castor";
    $appPath = "$root/app";
    $toolsPath = "$root/tools";
    if (is_dir('/app')) {
        $appPath = '/app';
        $toolsPath = '/tools';
    }

    $globalDockerContext = new CastorDockerContext(
        container: 'franken-base-app-1',
        serviceName: 'app',
        user: 'www-data',
        group: 'www-data',
        workdir: '/app',
        allowRunningInsideContainer: true
    );

    return new Context(
        data: [
            'paths' => [
                'castor' => $castorPath,
                'app' => $appPath,
                'tools' => $toolsPath,
            ],
            'docker' => [
                'composer' => $globalDockerContext,
                'php bin/console' => $globalDockerContext,
            ]
        ],
        currentDirectory: $appPath,
        tty: true, // Required for docker exec (interactive mode), see how to handle it in the future
        timeout: 0
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
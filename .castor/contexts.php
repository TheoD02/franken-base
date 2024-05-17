<?php

declare(strict_types=1);

use Castor\Attribute\AsContext;
use Castor\Context;
use TheoD02\Castor\Docker\CastorDockerContext;

define('ROOT_DIR', dirname(__DIR__));

#[AsContext]
function root_context(): Context
{
    return new Context(workingDirectory: ROOT_DIR);
}

#[AsContext(default: true)]
function default_context(): Context
{
    $defaultDocker = new CastorDockerContext(
        container: 'franken-base-app',
        serviceName: 'app',
        workdir: '/app',
        user: 'www-data',
        allowRunningInsideContainer: true,
    );

    $backend = clone $defaultDocker;
    $frontend = clone $defaultDocker;

    return root_context()
        ->withData([
            'docker' => [
                'default' => $defaultDocker,
                'php' => $defaultDocker,
                'composer' => $backend,
                'npm' => $frontend,
            ],
        ])
        ->withWorkingDirectory(ROOT_DIR . '/app')
    ;
}

#[AsContext]
function qa_context(): Context
{
    return default_context()
        ->withWorkingDirectory(ROOT_DIR . '/tools')
    ;
}

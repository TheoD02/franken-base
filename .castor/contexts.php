<?php

use Castor\Attribute\AsContext;
use Castor\Context;
use Castor\Utils\Docker\CastorDockerContext;

use function Castor\context;

/**
 * Return current context directory with optional additional path
 *
 * @param string|null $path
 * @return string
 */
function path(?string $path = null, ?Context $context = null): string
{
    $context ??= context();
    $currentDirectory = $context->currentDirectory;

    if ($path === null) {
        return $currentDirectory;
    }

    if (str_starts_with($path, '/')) {
        return "{$currentDirectory}{$path}";
    }

    return "{$currentDirectory}/{$path}";
}

define('ROOT_DIR', dirname(__DIR__));

#[AsContext(name: 'app', default: true)]
function default_context(): Context
{
    $castorPath = ROOT_DIR . '/.castor';
    $appPath = ROOT_DIR . '/app';
    $toolsPath = ROOT_DIR . '/tools';
    if (is_dir('/app')) {
        $appPath = '/app';
        $toolsPath = '/tools';
    }

    $globalDockerContext = new CastorDockerContext(
        container: 'franken-base-app-1',
        serviceName: 'app',
        workdir: '/app',
        user: 'www-data',
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
                'default' => $globalDockerContext,
            ]
        ],
        currentDirectory: $appPath,
        tty: true, // Required for docker exec (interactive mode), see how to handle it in the future
        timeout: 0
    );
}

#[AsContext(name: 'qa')]
function qa(): Context
{
    return default_context()
        ->withName('qa')
        ->withPath(context('app')->data['paths']['app']);
}
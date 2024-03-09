<?php

declare(strict_types=1);

use Castor\Attribute\AsContext;
use Castor\Context;
use Castor\Utils\Docker\CastorDockerContext;

use function Castor\context;

/**
 * Return current context directory with optional additional path.
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

    // TODO: Check if work in all cases
    $dirname = basename(dirname(__DIR__));
    $kebab = str_replace(['_', ' '], '-', $dirname);

    $globalDockerContext = new CastorDockerContext(
        container: "{$kebab}-app-1",
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
            ],
        ],
        currentDirectory: $appPath,
        tty: true, // Required for docker exec (interactive mode), see how to handle it in the future
        timeout: 0
    );
}

#[AsContext(name: 'qa')]
function qa(): Context
{
    $baseContext = default_context()->data['docker']['default'];

    /** @var CastorDockerContext $composerContext */
    $composerContext = clone $baseContext;
    $composerContext->workdir = '/tools';

    return default_context()
        ->withData([
            'docker' => [
                'composer' => $composerContext,
            ],
        ])
        ->withName('qa')
        ->withPath(context('app')->data['paths']['app'])
    ;
}

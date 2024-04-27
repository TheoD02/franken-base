<?php


use Castor\Attribute\AsListener;
use Castor\Event\AfterExecuteTaskEvent;
use Castor\Event\BeforeExecuteTaskEvent;

use Symfony\Component\Process\ExecutableFinder;
use function Castor\context;
use function Castor\io;
use function TheoD02\Castor\Docker\docker;

#[AsListener(BeforeExecuteTaskEvent::class, priority: 1000)]
function check_tool_deps(BeforeExecuteTaskEvent $event): void
{
    if ((new ExecutableFinder())->find('docker') === null) {
        io()->error([
            'Docker is required for running this application',
            'Check documentation: https://docs.docker.com/engine/install'
        ]);
        exit(1);
    }
}


#[AsListener(BeforeExecuteTaskEvent::class, priority: 900)]
function check_docker_is_running(BeforeExecuteTaskEvent $event): void
{
    if (in_array($event->task->getName(), ['start', 'stop', 'restart', 'install'])) {
        return;
    }

    $context = context()->withQuiet();
    if (str_contains(docker($context)->compose()->ps()->getOutput(), 'franken-base-app-1') === false) {
        io()->note('Docker containers are not running. Starting them.');
        start();
    }
}

#[AsListener(BeforeExecuteTaskEvent::class, priority: 800)]
#[AsListener(AfterExecuteTaskEvent::class, priority: 800)]
function check_projects_deps(BeforeExecuteTaskEvent|AfterExecuteTaskEvent $event): void
{
    if ($event instanceof BeforeExecuteTaskEvent && in_array($event->task->getName(), ['start', 'stop', 'restart', 'install'])) {
        return;
    }

    if ($event->task->getName() === 'install') {
        return;
    }

    $deps = [
        'Node Modules' => default_context()->workingDirectory . '/app/node_modules',
        'Composer' => default_context()->workingDirectory . '/app/vendor',
    ];

    $missingDeps = [];

    foreach ($deps as $depName => $path) {
        if (is_dir($path) === false) {
            $missingDeps[] = $depName;
        }
    }

    if ($missingDeps !== []) {
        io()->newLine();
        io()->error('Some dependencies are missing:');
        io()->listing($missingDeps);

        if (io()->confirm('Do you want to install them now?') === false) {
            io()->note('Run `castor install` to install them.');
            exit(1);
        }

        install();
    }
}
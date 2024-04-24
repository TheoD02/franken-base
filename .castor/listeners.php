<?php


use Castor\Attribute\AsListener;
use Castor\Event\BeforeExecuteTaskEvent;

use Symfony\Component\Process\ExecutableFinder;
use function Castor\context;
use function Castor\io;
use function TheoD02\Castor\Docker\docker;

#[AsListener(BeforeExecuteTaskEvent::class, priority: 1000)]
function check_deps(BeforeExecuteTaskEvent $event): void
{
    if ((new ExecutableFinder())->find('docker') === null) {
        io()->error([
            'Docker is required for running this application',
            'Check documentation: https://docs.docker.com/engine/install'
        ]);
        exit(1);
    }
}

#[AsListener(BeforeExecuteTaskEvent::class, priority: 10)]
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
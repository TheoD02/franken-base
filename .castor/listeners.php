<?php


use Castor\Attribute\AsListener;
use Castor\Event\BeforeExecuteTaskEvent;

use function Castor\context;
use function Castor\io;
use function TheoD02\Castor\Docker\docker;

#[AsListener(BeforeExecuteTaskEvent::class)]
function listener(BeforeExecuteTaskEvent $event): void
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
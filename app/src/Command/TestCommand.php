<?php

namespace App\Command;

use Symfony\Component\Scheduler\Attribute\AsPeriodicTask;

use function file_put_contents;

#[AsPeriodicTask(frequency: '10 seconds')]
class TestCommand
{
    public function __invoke(): void
    {
        file_put_contents('test.txt', 'test');
    }
}

<?php

use Castor\Context;

use Symfony\Component\Process\Process;

use function Castor\context;

class Symfony
{
    use RunnerTrait {
        __construct as private __runnerTraitConstruct;
    }

    public function __construct(private readonly Context $context)
    {
        $this->__runnerTraitConstruct($context);
    }

    private function getBaseCommand(): string
    {
        return 'php bin/console';
    }


    private function runWithDocker(): bool
    {
        return true;
    }

    private function allowRunningInsideContainer(): bool
    {
        return true;
    }

    public function console(string $command): Process
    {
        return $this->add($command)->runCommand();
    }
}

function symfony(?Context $context = null): Symfony
{
    return new Symfony($context ?? context());
}
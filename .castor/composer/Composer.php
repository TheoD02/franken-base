<?php

use Castor\Context;

use Symfony\Component\Process\Process;

use function Castor\context;

class Composer
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
        return 'composer';
    }


    private function runWithDocker(): bool
    {
        return true;
    }

    public function install(?string $workingDirectory = null): Process
    {
        $this->addIf($workingDirectory, '--working-dir', $workingDirectory);
        return $this->add('install')->runCommand();
    }
}

function composer(?Context $context = null): Composer
{
    return new Composer($context ?? context());
}
<?php

declare(strict_types=1);

use Castor\Context;
use Symfony\Component\Process\Process;
use TheoD02\Castor\Classes\AsTaskClass;
use TheoD02\Castor\Classes\AsTaskMethod;
use TheoD02\Castor\Docker\RunnerTrait;

use function Castor\context;
use function Castor\io;

#[AsTaskClass]
class Npm
{
    use RunnerTrait {
        __construct as private __runnerConstruct;
    }

    public function __construct(?Context $context = null)
    {
        $this->__runnerConstruct($context ?? context());

        if (
            ! is_file(default_context()->workingDirectory . '/package.json')
            && ! is_file(default_context()->workingDirectory . '/yarn.lock')
        ) {
            io()->warning('No package.json or yarn.lock file found in the working directory');
        }
    }

    public function run(string $command): Process
    {
        return $this->add('run', $command)->runCommand();
    }

    protected function getBaseCommand(): ?string
    {
        return 'npm';
    }

    protected function allowRunningUsingDocker(): bool
    {
        return true;
    }

    #[AsTaskMethod]
    public function install(): Process
    {
        return $this->add('install')->runCommand();
    }
}

function npm(?Context $context = null): Npm
{
    return new Npm($context);
}

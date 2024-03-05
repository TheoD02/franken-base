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

    protected function getBaseCommand(): string
    {
        return 'composer';
    }

    protected function allowRunningUsingDocker(): bool
    {
        return true;
    }

    public function createProject(string $name, string $path): Process
    {
        $this->add('create-project', $name, $path);

        return $this->runCommand();
    }

    public function install(?string $workingDirectory = null): Process
    {
        $this->addIf($workingDirectory, '--working-dir', $workingDirectory);
        return $this->add('install')->runCommand();
    }

    public function require(string|array $packages, bool $dev = false, bool $withDependencies = false): Process
    {
        $packages = is_string($packages) ? [$packages] : $packages;
        $this->addIf($dev, '--dev');
        $this->addIf($withDependencies, '--with-dependencies');

        return $this->add('require', ...$packages)->runCommand();
    }

    public function update(string|array|null $packages = null, bool $dev = false, bool $withDependencies = false): Process
    {
        $packages = is_string($packages) ? [$packages] : ($packages ?? []);
        $this->addIf($dev, '--dev');
        $this->addIf($withDependencies, '--with-all-dependencies');

        return $this->add('update', ...$packages)->runCommand();
    }
}

function composer(?Context $context = null): Composer
{
    return new Composer($context ?? context());
}
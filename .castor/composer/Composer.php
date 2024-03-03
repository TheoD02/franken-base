<?php

use Castor\Context;

use Castor\Utils\Docker\DockerUtils;
use Symfony\Component\Process\Process;

use function Castor\context;
use function Castor\run;
use function Castor\Utils\Docker\docker;

trait RunnerTrait
{
    private array $commands = [];

    abstract private function getBaseCommand(): string;

    abstract private function runWithDocker(): bool;

    abstract private function allowRunningInsideContainer(): bool;

    public function __construct(private readonly Context $castorContext)
    {
    }

    public function mergeCommands(mixed ...$commands): string
    {
        $commandsAsArrays = array_map(
            callback: static fn($command) => is_array($command) ? $command : explode(' ', $command),
            array: $commands
        );
        $flattened = array_reduce(
            array: $commandsAsArrays,
            callback: static fn($carry, $item) => [...$carry, ...$item],
            initial: []
        );

        return implode(' ', $flattened);
    }

    public function add(string $command): self
    {
        $this->commands[] = $command;
        return $this;
    }

    public function addIf(mixed $condition, string $key = null, string|array $value = null): void
    {
        if ($condition !== false) {
            if ($key === null) {
                $this->commands[] = is_array($value) ? implode(' ', $value) : $value;
            } elseif ($value === null) {
                $this->commands[] = $key;
            } elseif (is_array($value)) {
                $this->commands[] = $key . ' ' . implode(' ' . $key . ' ', $value);
            } else {
                $this->commands[] = $key . ' ' . $value;
            }
        }
    }

    public function runCommand(): Process
    {
        $commands = $this->mergeCommands($this->getBaseCommand(), $this->commands);

        $isRunningInsideContainer = DockerUtils::isRunningInsideContainer();
        if ($isRunningInsideContainer && $this->allowRunningInsideContainer() === false) {
            throw new \RuntimeException('This command cannot be run inside a container.');
        }

        if ($isRunningInsideContainer === false && $this->runWithDocker()) {
            /** @var array<string, DockerContext> $docker */
            $docker = \Castor\variable('docker');

            if ($docker === null) {
                throw new \RuntimeException('A array of DockerContext is required to run this command outside a container.');
            }

            $dockerContext = $docker[$this->getBaseCommand()] ?? null;

            if ($dockerContext === null) {
                throw new \RuntimeException(sprintf('DockerContext for "%s" is required to run this command outside a container. [\'docker\' => [\'%s\' => new DockerContext()]]', $this->getBaseCommand(), $this->getBaseCommand()));
            }

            return docker()->compose()->exec(service: $dockerContext->serviceName, args: [$commands]);
        }

        $runProcess = run($commands, context: $this->castorContext);
        $this->commands = [];
        return $runProcess;
    }
}

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

    private function allowRunningInsideContainer(): bool
    {
        return true;
    }

    public function install(): Process
    {
        return $this->add('install')->runCommand();
    }
}

function composer(?Context $context = null): Composer
{
    return new Composer($context ?? context());
}
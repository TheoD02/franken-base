<?php

use Castor\Context;
use Castor\Utils\Docker\CastorDockerContext;
use Castor\Utils\Docker\DockerUtils;

use Symfony\Component\Process\Process;

use function Castor\context;
use function Castor\io;
use function Castor\run;
use function Castor\Utils\Docker\docker;

trait RunnerTrait
{
    private array $commands = [];


    public function __construct(private readonly Context $castorContext)
    {
    }

    /**
     * Return the base command, e.g. 'composer'
     * If null is returned, the base command will fallback to "default", that mean no base command is required, but the context will be used as default.
     *
     * // TODO: Better pattern for this null case
     *
     * @return string|null
     */
    abstract private function getBaseCommand(): ?string;

    abstract private function runWithDocker(): bool;

    /**
     * Use that for running anything before the command is executed (e.g. setting environment variables, some checks, etc.)
     *
     * @return void
     */
    private function preRunCommand(): void
    {
        return;
    }

    public function mergeCommands(mixed ...$commands): string
    {
        $commands = array_filter($commands);

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

    public function add(string ...$commands): self
    {
        $this->commands = [...$this->commands, ...$commands];
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
        $dockerContext = null;
        if ($this->runWithDocker()) {
            /** @var ?array<string, CastorDockerContext> $docker */
            $docker = $this->castorContext->data['docker'] ?? null;

            if ($docker === null) {
                throw new \RuntimeException('A array of CastorDockerContext is required to run this command outside a container.');
            }

            $dockerContext = $docker[$this->getBaseCommand() ?? 'default'] ?? null;

            if ($dockerContext === null) {
                throw new \RuntimeException(
                    sprintf(
                        'DockerContext for "%s" is required to run this command outside a container. [\'docker\' => [\'%s\' => new DockerContext()]]',
                        $this->getBaseCommand(),
                        $this->getBaseCommand()
                    )
                );
            }
        }

        if ($isRunningInsideContainer === false && $this->runWithDocker()) {
            $this->preRunCommand();
            return docker()->compose()->exec(service: $dockerContext->serviceName, args: [$commands], user: $dockerContext->user, workdir: $dockerContext->workdir);
        }

        if ($isRunningInsideContainer === true && $dockerContext->allowRunningInsideContainer === false) {
            $contextName = context()->name;
            $curentDockerContextName = $this->getBaseCommand() ?? 'default';
            io()->error([
                "Context '{$contextName}' with Docker context '{$curentDockerContextName}' does not allow running this command inside the container.",
                "Please run it outside the container or set 'allowRunningInsideContainer' to true in the docker context.",
                "Current context: " . context()->name,
                "Command: " . $commands
            ]);
            exit(1);
        }

        $this->preRunCommand();
        $runProcess = run($commands, context: $this->castorContext);
        $this->commands = [];
        return $runProcess;
    }
}
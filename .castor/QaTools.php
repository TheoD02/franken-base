<?php

use Castor\Attribute\AsOption;
use Symfony\Component\Process\Process;

use function Castor\finder;
use function Castor\fingerprint;
use function Castor\fs;
use function Castor\hasher;
use function Castor\io;

#[AsTaskClass(namespace: 'qa')]
class QaTools
{
    use RunnerTrait {
        __construct as private __runnerTraitConstruct;
    }

    public function __construct()
    {
        $this->__runnerTraitConstruct(qa());
    }

    private function getBaseCommand(): ?string
    {
        return null;
    }

    private function runWithDocker(): bool
    {
        return true;
    }

    private function preRunCommand(): void
    {
        $tools = finder()
            ->in(qa()->data['paths']['tools'])
            ->notName(['bin', 'k6'])
            ->depth(0)
            ->directories();

        io()->writeln('Checking tools installation');
        foreach ($tools as $tool) {
            io()->write("{$tool->getFilename()}...");
            $toolDirectory = "/tools/{$tool->getFilename()}";
            if (!fs()->exists("$toolDirectory/composer.json")) {
                io()->error("The tool {$tool->getFilename()} does not contain a composer.json file");
                exit(1);
            }

            $needForceInstall = fs()->exists("$toolDirectory/vendor") === false;

            fingerprint(
                callback: function () use ($toolDirectory) {
                    composer(qa()->withQuiet())->install(workingDirectory: $toolDirectory);
                },
                fingerprint: hasher()
                    ->writeFile("$toolDirectory/composer.json")
                    ->writeFile("$toolDirectory/composer.lock")
                    ->finish(),
                force: $needForceInstall
            );
            io()->writeln(' <info>OK</info>');
        }
        io()->newLine();
    }

    #[AsTaskMethod]
    public function ecs(#[AsOption] bool $fix = false): Process
    {
        $this->add('ecs', 'check', '--clear-cache', '--ansi', '--config', '/app/ecs.php');

        $this->addIf($fix, '--fix');

        return $this->runCommand();
    }

    #[AsTaskMethod]
    public function phpstan(): Process
    {
        $this->add('phpstan', 'clear-result-cache')->runCommand();

        return $this
            ->add('phpstan', 'analyse', 'src', '--level=8', '--configuration', '/app/phpstan.neon')
            ->runCommand();
    }

    #[AsTaskMethod]
    public function rector(): Process
    {
        return $this
            ->add('rector', 'process', '--clear-cache', '--config', '/app/rector.php')
            ->runCommand();
    }

    #[AsTaskMethod(aliases: ['qa:arki'])]
    public function phparkitect(): Process
    {
        return $this
            ->add('phparkitect', 'check', '--ansi', '--config', '/app/phparkitect.php')
            ->runCommand();
    }
}

#[AsTaskClass(namespace: 'qa')]
class QaVendor
{
    use RunnerTrait {
        __construct as private __runnerTraitConstruct;
    }

    public function __construct()
    {
        $this->__runnerTraitConstruct(default_context());
    }

    private function getBaseCommand(): ?string
    {
        return null;
    }

    private function runWithDocker(): bool
    {
        return true;
    }

    #[AsTaskMethod(aliases: ['qa:test'])]
    public function phpunit(): void
    {
        $this->add('vendor/bin/phpunit')->runCommand();
    }
}
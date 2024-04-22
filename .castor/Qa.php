<?php

use Castor\Attribute\AsOption;
use Symfony\Component\Process\Process;
use TheoD02\Castor\Classes\AsTaskClass;
use TheoD02\Castor\Classes\AsTaskMethod;
use TheoD02\Castor\Docker\CastorDockerContext;
use TheoD02\Castor\Docker\RunnerTrait;

use function Castor\context;
use function Castor\finder;
use function Castor\fingerprint;
use function Castor\fs;
use function Castor\hasher;
use function Castor\io;

#[AsTaskClass]
class Qa
{
    use RunnerTrait {
        __construct as private __runnerTraitConstruct;
    }

    private static bool $runOnce = false;

    public function __construct()
    {
        $this->__runnerTraitConstruct(qa());
    }

    protected function allowRunningUsingDocker(): bool
    {
        return true;
    }

    private function preRunCommand(): void
    {
        if (self::$runOnce) {
            return;
        }

        $tools = finder()
            ->in(qa()->workingDirectory)
            ->notName(['bin', 'k6'])
            ->depth(0)
            ->directories();

        io()->writeln('Checking tools installation');
        foreach ($tools as $tool) {
            $toolDirectory = $tool->getPathname();
            io()->write("{$toolDirectory}...");
            if (!fs()->exists("{$toolDirectory}/composer.json")) {
                io()->error("The tool {$toolDirectory} does not contain a composer.json file");
                exit(1);
            }

            $needForceInstall = fs()->exists("{$toolDirectory}/vendor") === false;

            /** @var CastorDockerContext $composerDockerContext */
            $composerDockerContext = context()->data['docker']['composer'] ?? context()->data['docker']['default'];
            $composerDockerContext->workdir = '/tools/' . $tool->getFilename();
            $context = qa()
                ->withQuiet()
                ->withData([
                    'docker' => [
                        'composer' => $composerDockerContext,
                    ]
                ]);

            fingerprint(
                callback: static function () use ($context) {
                    io()->write(' Installing...');
                    composer($context)->install();
                },
                fingerprint: hasher()
                    ->writeFile("{$toolDirectory}/composer.json")
                    ->writeFile("{$toolDirectory}/composer.lock")
                    ->finish(),
                force: $needForceInstall
            );
            io()->writeln(' <info>OK</info>');
        }
        io()->newLine();

        self::$runOnce = true;
    }

    #[AsTaskMethod]
    public function ecs(#[AsOption(description: 'Fix the issues')] bool $fix = false): Process
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
            ->add('phpstan', 'analyse', '--level=8', '--configuration', '/app/phpstan.neon', '--memory-limit=1G')
            ->runCommand();
    }

    #[AsTaskMethod]
    public function rector(#[AsOption(description: 'Fix the issues')] bool $fix = false): Process
    {
        $this->add('rector', 'process', '--clear-cache', '--config', '/app/rector.php');

        $this->addIf(!$fix, '--dry-run');

        return $this->runCommand();
    }

    #[AsTaskMethod(aliases: ['qa:arki'])]
    public function phparkitect(): Process
    {
        return $this
            ->add('phparkitect', 'check', '--ansi', '--config', '/app/phparkitect.php')
            ->runCommand();
    }

    #[AsTaskMethod(aliases: ['qa:phpmd'])]
    public function phpmd(): Process
    {
        return $this
            ->add('phpmd', '/app/src', 'text', 'codesize,unusedcode')
            ->runCommand();
    }
}
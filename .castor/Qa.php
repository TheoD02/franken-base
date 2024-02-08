<?php

use Castor\Extras\DockerUtils;
use Symfony\Component\Process\Process;

use function Castor\finder;
use function Castor\fingerprint;
use function Castor\fs;
use function Castor\hasher;
use function Castor\io;

#[AsTaskClass]
class Qa
{
    private static ?string $toolsDirectory = null;

    public static function ensureToolsInstalled(): void
    {
        self::$toolsDirectory ??= DockerUtils::resolveWorkdirFromContext(qa());
        $tools = finder()
            ->in(qa()->currentDirectory)
            ->notName('bin')
            ->depth(0)
            ->directories();

        foreach ($tools as $tool) {
            if (!fs()->exists($tool->getPathname() . '/composer.json')) {
                io()->error("The tool {$tool->getFilename()} does not contain a composer.json file");
                exit(1);
            }

            $needForceInstall = fs()->exists($tool->getPathname() . '/vendor') === false;

            fingerprint(
                callback: function () use ($tool) {
                    Composer::install(self::$toolsDirectory . '/' . $tool->getFilename());
                },
                fingerprint: hasher()
                    ->writeFile($tool->getPathname() . '/composer.json')
                    ->writeFile($tool->getPathname() . '/composer.lock')
                    ->finish(),
                force: $needForceInstall
            );
        }
    }

    private static function runTool(string $tool, string $args = ''): Process
    {
        self::ensureToolsInstalled();
        return Docker::exec("$tool $args", tty: true, interactive: true);
    }

    #[AsTaskMethod]
    public static function ecs(): Process
    {
        return self::runTool('ecs check src');
    }

    #[AsTaskMethod]
    public static function phpstan(): Process
    {
        return self::runTool('phpstan analyse src');
    }

    #[AsTaskMethod]
    public static function rector(): Process
    {
        return self::runTool('rector process src');
    }
}
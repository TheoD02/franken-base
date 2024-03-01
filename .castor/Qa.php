<?php

use Castor\Attribute\AsOption;
use Castor\Extras\DockerUtils;
use Symfony\Component\Process\Process;

use function Castor\finder;
use function Castor\fingerprint;
use function Castor\fs;
use function Castor\hasher;
use function Castor\io;
use function utils\add_param_if;

#[AsTaskClass]
class Qa
{
    private static ?string $toolsDirectory = null;

    public static function ensureToolsInstalled(): void
    {
        self::$toolsDirectory ??= DockerUtils::resolveWorkdirFromContext(qa());
        $tools = finder()
            ->in(qa()->currentDirectory)
            ->notName(['bin', 'k6'])
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
    public static function ecs(
        #[AsOption] bool $fix = false,
    ): Process {
        $params = ['ecs', 'check', '--clear-cache', '--ansi'];
        add_param_if($params, $fix, '--fix');
        return self::runTool(implode(' ', $params));
    }

    #[AsTaskMethod]
    public static function phpstan(): Process
    {
        self::runTool('phpstan clear-result-cache');
        return self::runTool('phpstan analyse src -l 8');
    }

    #[AsTaskMethod]
    public static function rector(): Process
    {
        return self::runTool('rector process --clear-cache');
    }

    #[AsTaskMethod]
    public static function test(): Process
    {
        return Composer::runVendorBin('phpunit');
    }

    #[AsTaskMethod]
    public static function phpunit(): Process
    {
        return Composer::runVendorBin('phpunit');
    }
}
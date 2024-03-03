<?php

use Castor\Attribute\AsOption;
use Castor\Attribute\AsTask;


use Castor\Utils\Docker\DockerUtils;

use function Castor\fingerprint;
use function Castor\fs;
use function Castor\import;
use function Castor\input;
use function Castor\io;
use function Castor\Utils\Docker\docker;
use function fingerprints\composer_fingerprint;
use function fingerprints\dockerfile_fingerprint;

import('./.castor/extras');
import('./.castor');

//import(default_context()['paths']['castor']);
import(default_context()['paths']['tools'] . '/k6/castor.php');


#[AsTask(description: 'Start project')]
function start(bool $force = false): void
{
    if (DockerUtils::isRunningInsideContainer() === false) {
        fingerprint(
            callback: fn() => docker()->compose()->build(services: ['app'], noCache: true),
            fingerprint: dockerfile_fingerprint(),
            force: $force
        );

        docker()->compose(profile: ['app'])->up(detach: true, wait: true);
    }

    init_project();
    //docker()->compose(profile: ['worker'])->up(detach: true, wait: false);
}

#[AsTask(description: 'Stop project')]
function stop(): void
{
    docker()->compose(profile: ['app'])->down();
    //docker()->compose(profile: ['worker'])->down();
}

#[AsTask(description: 'Restart project')]
function restart(): void
{
    stop();
    start();
}

#[AsTask(description: 'Install project')]
function install(bool $force = false): void
{
    start(force: $force);
    fingerprint(callback: fn() => composer()->install(), fingerprint: composer_fingerprint(), force: $force);
}

#[AsTask(description: 'Open shell in the container (default: fish)', aliases: ['sh', 'fish'])]
function shell(
    #[AsOption(description: 'If run as root')]
    bool $root = false
): void {
    $shell = input()->getArgument('command') === 'shell' ? 'fish' : input()->getArgument('command');
    docker()->exec(container: 'franken-base-app-1', args: [$shell], interactive: true, tty: true, user: $root ? 'root' : 'www-data');
}

function init_project(): void
{
    if (fs()->exists(path('composer.json'))) {
        return;
    }

    $ecsContent = <<<PHP
<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/tools/ecs/BaseECSConfig.php';

return BaseECSConfig::config();
PHP;

    $rectorContent = <<<PHP
<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/tools/rector/BaseRectorConfig.php';

return BaseRectorConfig::config();
PHP;

    $sfVersion = io()->choice('Which version of Symfony do you want to use?', ['5.4', '6.4', '7.*'], '6.4');
    io()->writeln('Creating Symfony project...');

    docker()->exec(container: 'franken-base-app-1', args: ['composer create-project symfony/skeleton:"' . $sfVersion . '.*" tmp']);
    $currentDir = path();
    fs()->mirror("{$currentDir}/tmp", $currentDir);

    fs()->remove("{$currentDir}/tmp");

    io()->info('Setting up ECS and Rector...');
    file_put_contents("{$currentDir}/ecs.php", $ecsContent);
    file_put_contents("{$currentDir}/rector.php", $rectorContent);

    docker()->exec(container: 'franken-base-app-1', args: ['composer require --dev symfony/debug-pack symfony/maker-bundle']);
    docker()->exec(container: 'franken-base-app-1', args: ['composer require twig-bundle']);

    $front = io()->choice('Use webpack-encore or vite ?', ['webpack-encore', 'vite'], 'webpack-encore');

    if ($front === 'webpack-encore') {
        docker()->exec(container: 'franken-base-app-1', args: ['composer require symfony/webpack-encore-bundle']);
    } else {
        docker()->exec(container: 'franken-base-app-1', args: ['composer require pentatrion/vite-bundle']);
    }

    $envLocalContent = file_get_contents("{$currentDir}/.env.local");
    $envLocalContent = str_replace('{PROJECT_PATH}', $currentDir, $envLocalContent);
    file_put_contents("{$currentDir}/.env.local", $envLocalContent);
}

#[AsTask(name: 'db:reset', description: 'Reset the database')]
function db_reset(): void
{
    symfony()->console('doctrine:database:drop --force --if-exists');
    symfony()->console('doctrine:database:create');
    symfony()->console('doctrine:schema:create');
    symfony()->console('doctrine:fixtures:load --no-interaction');
}

function format_php(): void
{
    $files = fs()->find(path('src'), path('tests'))->name('*.php');
    docker()->exec(container: 'franken-base-app-1', args: ['php-cs-fixer', 'fix', '--config=.php_cs.dist', '--using-cache=no', ...$files]);
}
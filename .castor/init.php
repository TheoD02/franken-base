<?php

use function Castor\context;
use function Castor\fs;
use function Castor\io;

function init(): void
{
    $appDir = context()->currentDirectory . '/app';
    if (fs()->exists("$appDir/composer.json")) {
        // return;
    }

    $symfonyVersionToInstall = io()->choice(
        'Which version of Symfony do you want to install?',
        ['7.0', '6.4', '5.4'],
        default: '6.4'
    );

    Composer::cmd("create-project symfony/skeleton:\"^$symfonyVersionToInstall\" sf");

    fs()->mirror("$appDir/sf", $appDir);
    fs()->remove("$appDir/sf");

    $installedPhpVersion = Docker::exec('php -r "echo PHP_VERSION;"', tty: false)->getOutput();
    Composer::cmd("require \"php:>=$installedPhpVersion\" runtime/frankenphp-symfony");
    Composer::cmd('config --json extra.symfony.docker \'false\'');

    io()->success([
        'Symfony project has been installed',
        'You can now run `castor start` to start the project',
    ]);
    //fs()->remove(__FILE__); // Delete this file, we don't need it anymore
}
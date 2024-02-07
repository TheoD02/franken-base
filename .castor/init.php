<?php

use function Castor\fs;
use function Castor\io;

function init(): void
{
    if (fs()->exists('composer.json')) {
        return;
    }

    $symfonyVersionToInstall = io()->choice(
        'Which version of Symfony do you want to install?',
        ['7.0', '6.4', '5.4'],
        default: '6.4'
    );

    Composer::cmd("create-project symfony/skeleton:\"^$symfonyVersionToInstall\" sf");

    fs()->mirror('./sf/', './app');
    fs()->remove('sf');

    io()->success([
        'Symfony project has been installed',
        'You can now run `castor start` to start the project',
        '',
        'You can now remove the `init.php` file located at ./castor/init.php.',
        'This file is now useless and can be removed.'
    ]);
}
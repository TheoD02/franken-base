<?php

use Castor\Attribute\AsTask;

use function Castor\capture;
use function Castor\import;
use function Castor\io;
use function utils\import_from_git_remote;

import('./castor/utils.php');

import_from_git_remote('git@github.com:TheoD02/castor_extras.git');

#[AsTask(description: 'Welcome to Castor!')]
function hello(): void
{
    $currentUser = capture('whoami');

    io()->title(sprintf('Hello %s!', $currentUser));
}

#[AsTaskClass]
class Symfony
{
    #[AsTaskMethod(description: 'Run Symfony server')]
    public function server(): void
    {
        capture('symfony server:start');
    }
}

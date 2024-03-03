<?php

namespace fingerprints;

use function Castor\finder;
use function Castor\hasher;
use function dd;

use function path;

use const ROOT_DIR;

function dockerfile_fingerprint(): string
{
    return hasher()
        ->writeFile(ROOT_DIR . '/Dockerfile')
        ->writeWithFinder(
            finder()
                ->in(ROOT_DIR . '/docker')
        )
        ->finish();
}

function composer_fingerprint(): string
{
    return hasher()
        ->writeFile(path('composer.json'))
        ->writeFile(path('composer.lock'))
        ->finish();
}
<?php

namespace fingerprints;

use function Castor\finder;
use function Castor\hasher;

function dockerfile_fingerprint(): string
{
    return hasher()
        ->writeFile('Dockerfile')
        ->writeWithFinder(
            finder()
                ->in('docker')
        )
        ->finish();
}

function composer_fingerprint(): string
{
    return hasher()
        ->writeFile('composer.json')
        ->writeFile('composer.lock')
        ->finish();
}
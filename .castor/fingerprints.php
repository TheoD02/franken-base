<?php

namespace fingerprints;

use function Castor\hasher;

function dockerfile_fingerprint(): string
{
    return hasher()->writeFile('Dockerfile')->finish();
}

function composer_fingerprint(): string
{
    return hasher()
        ->writeFile('composer.json')
        ->writeFile('composer.lock')
        ->finish();
}
<?php

namespace fingerprints;

use function Castor\context;
use function Castor\hasher;

function dockerfile_fingerprint(): string
{
    return hasher()->writeFile('Dockerfile')->finish();
}

function composer_fingerprint(): string
{
    return hasher()
        ->writeFile(context()->currentDirectory. '/composer.json')
        ->writeFile(context()->currentDirectory. '/composer.lock')
        ->finish();
}
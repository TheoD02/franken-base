<?php

declare(strict_types=1);

namespace utils;

use Castor\Context;

use function Castor\context;

/**
 * Return current context directory with optional additional path.
 */
function path(?string $path = null, ?Context $context = null): string
{
    $context ??= context();
    $currentDirectory = $context->currentDirectory;

    if ($path === null) {
        return $currentDirectory;
    }

    if (str_starts_with($path, '/')) {
        return "{$currentDirectory}{$path}";
    }

    return "{$currentDirectory}/{$path}";
}

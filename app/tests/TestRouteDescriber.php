<?php

declare(strict_types=1);

namespace App\Tests;

class TestRouteDescriber
{
    public function __construct(
        public readonly string $method,
        public readonly string $uri,
    ) {
    }
}

<?php

namespace App\Tests;

class TestRouteDescriber
{
    public function __construct(
        public readonly string $method,
        public readonly string $uri,
    ) {
    }
}
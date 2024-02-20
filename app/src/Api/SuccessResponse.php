<?php

namespace App\Api;

#[\Attribute(\Attribute::TARGET_METHOD)]
class SuccessResponse
{
    public function __construct(
        public readonly string $class,
        public readonly array $groups = [],
    ) {
    }
}
<?php

namespace App\Api\Attribut;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class ArrayProperty
{
    public function __construct(
        public string $type,
        public array $example,
        public string $description = '',
        public bool $required = false,
        public array $groups = [],
    ) {
    }
}
<?php

#[\Attribute(\Attribute::TARGET_CLASS)]
class AsTaskClass
{
    public function __construct(
        public readonly ?string $namespace = null,
    ) {
    }
}
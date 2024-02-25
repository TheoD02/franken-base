<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

#[\Attribute(\Attribute::TARGET_METHOD)]
readonly class OpenApiMeta
{
    public function __construct(
        public string $class,
        public array $groups = [],
    ) {
        if (class_exists($class) === false) {
            throw new \RuntimeException(sprintf('The class "%s" does not exist.', $class));
        }
    }
}

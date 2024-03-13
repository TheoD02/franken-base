<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

/**
 * This class permit to define the metadata of an API response based on class and groups.
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
readonly class OpenApiMeta
{
    /**
     * @param string $class
     * @param array<string> $groups
     */
    public function __construct(
        public string $class,
        public array $groups = [],
    ) {
        if (class_exists($class) === false) {
            throw new \RuntimeException(sprintf('The class "%s" does not exist.', $class));
        }
    }
}

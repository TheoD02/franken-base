<?php

declare(strict_types=1);

namespace App\Attribute;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class LazyFetchResource
{
    /**
     * @param class-string $collectionFqcn
     */
    public function __construct(
        public readonly string $collectionFqcn,
    ) {
    }
}

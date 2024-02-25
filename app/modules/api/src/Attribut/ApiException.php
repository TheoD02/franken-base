<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

#[\Attribute(\Attribute::TARGET_METHOD)]
class ApiException
{
    public function __construct(
        public readonly string $exceptionFqcn,
    ) {
    }
}

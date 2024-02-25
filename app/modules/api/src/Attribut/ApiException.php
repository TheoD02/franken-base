<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

#[\Attribute(\Attribute::TARGET_METHOD|\Attribute::IS_REPEATABLE)]
class ApiException
{
    public function __construct(
        public readonly string $exceptionFqcn,
    ) {
    }
}

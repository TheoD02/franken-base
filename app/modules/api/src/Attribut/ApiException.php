<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

use Symfony\Component\HttpFoundation\Response;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class ApiException
{
    public function __construct(
        /** @var class-string $exceptionFqcn */
        public readonly string $exceptionFqcn,
    ) {
    }
}

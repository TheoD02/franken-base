<?php

declare(strict_types=1);

namespace Module\Api\ValueObject;

class Identifier
{
    public function __construct(
        public int|string $identifier
    ) {
    }
}

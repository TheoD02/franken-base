<?php

namespace App\User;

use OpenApi\Attributes\Property;

class UserMeta
{
    public function __construct(
        public int $total,
        public int $page,
        public int $limit,
    ) {
    }
}
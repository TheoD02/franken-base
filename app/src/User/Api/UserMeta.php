<?php

declare(strict_types=1);

namespace App\User\Api;

class UserMeta
{
    public function __construct(
        public int $total,
        public int $page,
        public int $limit,
    ) {
    }
}

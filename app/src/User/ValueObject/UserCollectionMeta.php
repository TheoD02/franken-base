<?php

declare(strict_types=1);

namespace App\User\ValueObject;

use Module\Api\Adapter\ApiMetadataInterface;

class UserCollectionMeta implements ApiMetadataInterface
{
    public function __construct(
        public int $total,
        public int $page,
        public int $limit,
    ) {
    }
}

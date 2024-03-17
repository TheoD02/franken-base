<?php

declare(strict_types=1);

namespace Module\Api\ValueObject;

use Module\Api\Adapter\ApiMetadataInterface;

readonly class GenericCollectionMetadata implements ApiMetadataInterface
{
    public function __construct(
        private int $total,
        private int $page,
        private int $limit
    ) {
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}

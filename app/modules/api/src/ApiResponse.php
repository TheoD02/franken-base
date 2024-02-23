<?php

namespace Module\Api;

use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\Adapter\ApiDataInterface;
use Module\Api\Adapter\ApiMetadataInterface;

/**
 * @template T
 * @template M of object|null
 */
readonly class ApiResponse
{
    public function __construct(
        /**
         * @phpstan-var T
         */
        public null|ApiDataInterface|ApiDataCollectionInterface|bool $data,
        /**
         * @phpstan-var M
         */
        public ?ApiMetadataInterface $meta = null,
        public int $status = 200,
    ) {
        if ($this->data === null && $this->status !== 204) {
            throw new \InvalidArgumentException('The status code must be 204 when the data is null.');
        }
    }
}
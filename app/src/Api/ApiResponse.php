<?php

namespace App\Api;

use App\Api\Adapter\ApiDataCollectionInterface;
use App\Api\Adapter\ApiDataInterface;
use App\Api\Adapter\ApiMetadataInterface;

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
<?php

declare(strict_types=1);

namespace Module\Api\Dto;

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
        public ApiDataInterface|ApiDataCollectionInterface|bool|null $data,
        /**
         * @phpstan-var M
         */
        public ?ApiMetadataInterface $meta = null,
    ) {
    }
}

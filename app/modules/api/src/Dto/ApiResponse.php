<?php

declare(strict_types=1);

namespace Module\Api\Dto;

use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\Adapter\ApiDataInterface;
use Module\Api\Adapter\ApiMetadataInterface;
use Module\Api\Enum\HttpStatusEnum;

/**
 * @template T
 * @template M
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
        public ?ApiMetadataInterface $apiMetadata = null,
        public array $groups = [],
        public HttpStatusEnum $httpStatusEnum = HttpStatusEnum::OK,
    ) {
    }
}

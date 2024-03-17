<?php

declare(strict_types=1);

namespace Module\Api\Dto;

use Module\Api\Abstract\AbstractApiDataCollection;
use Module\Api\Adapter\ApiDataInterface;
use Module\Api\Adapter\ApiMetadataInterface;
use Module\Api\Enum\HttpStatusEnum;

/**
 * @template T of ApiDataInterface|AbstractApiDataCollection|bool|null
 * @template M of ApiMetadataInterface|null
 */
readonly class ApiResponse
{
    /**
     * @param array<string> $groups
     *
     * @phpstan-param T $data
     * @phpstan-param M $apiMetadata
     */
    public function __construct(
        public ApiDataInterface|AbstractApiDataCollection|bool|null $data,
        public ?ApiMetadataInterface $apiMetadata = null,
        public array $groups = [],
        public HttpStatusEnum $httpStatusEnum = HttpStatusEnum::OK,
    ) {
    }
}

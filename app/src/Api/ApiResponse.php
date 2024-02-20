<?php

namespace App\Api;

readonly class ApiResponse
{
    public function __construct(
        public null|ApiDataInterface|ApiDataCollectionInterface $data,
        public ?ApiMetadataInterface $meta = null,
        public int $status = 200,
    ) {
        if ($this->data === null && $this->status !== 204) {
            throw new \InvalidArgumentException('The status code must be 204 when the data is null.');
        }
    }
}
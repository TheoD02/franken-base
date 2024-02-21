<?php

namespace App\Api\Attribut;

use App\Api\Enum\ResponseType;

use function class_exists;
use function sprintf;

#[\Attribute(\Attribute::TARGET_METHOD)]
readonly class OpenApiResponse
{
    public function __construct(
        public string $class,
        public array $groups = [],
        public ResponseType $type = ResponseType::ITEM,
        public int $statusCode = 200,
    ) {
        if (class_exists($class) === false) {
            throw new \RuntimeException(sprintf('The class "%s" does not exist.', $class));
        }
    }

    public function isCollection(): bool
    {
        return $this->type === ResponseType::COLLECTION;
    }
}
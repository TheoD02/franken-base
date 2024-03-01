<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

use Module\Api\Enum\ResponseTypeEnum;

/**
 * This class permit to define the response of an endpoint.
 *
 * This will get the object and groups, it will convert it as openapi response with corresponding status code.
 *
 * If the status code is 204, it will be converted as no content automatically.
 *
 * @see OpenApiMeta If you want to document the metadata of the response.
 * @see ApiException If you want to document some error cases.
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
class OpenApiResponse
{
    public function __construct(
        public ?string $class = null,
        public ResponseTypeEnum $type = ResponseTypeEnum::ITEM,
        public bool $empty = false,
    ) {
        if ($this->empty === true) {
            \assert($this->class === null, 'The class must be null if the response is empty.');
        } else {
            \assert($this->class !== null, 'The class must be defined if the response is not empty.');
            if (class_exists($class) === false) {
                throw new \RuntimeException(sprintf('The class "%s" does not exist.', $class));
            }
        }
    }

    public function isCollection(): bool
    {
        return $this->type === ResponseTypeEnum::COLLECTION;
    }
}

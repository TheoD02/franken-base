<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

use Module\Api\Enum\HttpStatus;
use Module\Api\Enum\ResponseType;

use function assert;
use function sprintf;

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
        public array $groups = [],
        public ResponseType $type = ResponseType::ITEM,
        public HttpStatus $statusCode = HttpStatus::OK,
        public bool $empty = false,
    ) {
        if ($this->empty === true) {
            assert($this->class === null, 'The class must be null if the response is empty.');
            assert($this->groups === [], 'The groups must be empty if the response is empty.');
            $this->statusCode = HttpStatus::NO_CONTENT;
        } else {
            assert($this->class !== null, 'The class must be defined if the response is not empty.');
            if (class_exists($class) === false) {
                throw new \RuntimeException(sprintf('The class "%s" does not exist.', $class));
            }

            // Not sure about this condition, but thinking about it.
            if (!$this->statusCode->isSuccessful()) {
                // We don't want to describe the response in that way if it's not a successful response.
                throw new \RuntimeException(
                    sprintf(
                        'Document response is only normally possible for successful response. The response status code is %s.',
                        $this->statusCode->value
                    )
                );
            }
        }
    }

    public function isCollection(): bool
    {
        return $this->type === ResponseType::COLLECTION;
    }
}

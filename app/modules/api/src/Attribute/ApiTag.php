<?php

namespace Module\Api\Attribute;

use Module\Api\Enum\ApiTagEnum;
use Module\Api\Exception\MissingTagDescriptionException;
use OpenApi\Attributes\ExternalDocumentation;
use OpenApi\Attributes\Tag;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class ApiTag extends Tag
{
    /**
     * @throws MissingTagDescriptionException
     */
    public function __construct(
            ApiTagEnum $tag,
            ?ExternalDocumentation $externalDocs = null,
    ) {
        parent::__construct(
                name: $tag->value,
                description: $tag->getDescription(),
                externalDocs: $externalDocs,
        );
    }
}
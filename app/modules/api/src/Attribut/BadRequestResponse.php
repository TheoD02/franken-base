<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

use OpenApi\Attributes\Items;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;

#[\Attribute(\Attribute::TARGET_METHOD)]
class BadRequestResponse extends Response
{
    public function __construct()
    {
        parent::__construct(
            response: 400,
            description: 'Bad request.',
            content: new JsonContent(
                properties: [
                    new Property(property: 'type', example: 'https://symfony.com/errors/validation'),
                    new Property(property: 'title', example: 'Validation Failed'),
                    new Property(property: 'status', example: 422),
                    new Property(property: 'detail', example: 'The request data is invalid.'),
                    new Property(
                        property: 'violations',
                        type: 'array',
                        items: new Items(
                            properties: [
                                new Property(property: 'propertyPath', example: 'email'),
                                new Property(property: 'code', example: 'ERR_VALUE_NOT_VALID_EMAIL'),
                                new Property(property: 'value', example: 'incorrect-at-mail.fr'),
                                new Property(property: 'message', example: 'This value is not a valid email address.'),
                            ]
                        ),
                    ),
                ]
            )
        );
    }
}

<?php

namespace App\Api\Attribut;

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
                                new Property(property: 'title', example: 'ERR_VALUE_NOT_VALID_EMAIL'),
                                new Property(property: 'template', example: 'This value is not a valid email address.'),
                                new Property(property: 'parameters', example: ['{{ value }}' => 'test']),
                                new Property(
                                    property: 'type', example: 'urn:uuid:bd79c0ab-ddba-46cc-a703-a7a4b08de310'
                                ),
                            ]
                        ),
                    ),
                ]
            )
        );
    }
}

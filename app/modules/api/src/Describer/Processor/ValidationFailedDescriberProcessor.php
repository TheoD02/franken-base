<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use Module\Api\Describer\Trait\JsonContentDescriberProcessTrait;
use Module\Api\Enum\ApiErrorTypeEnum;
use Module\Api\Enum\HttpStatusEnum;
use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use OpenApi\Annotations as OAnnotations;
use OpenApi\Attributes as OAttributes;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Generator;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Route;

class ValidationFailedDescriberProcessor implements DescriberProcessorInterface
{
    use JsonContentDescriberProcessTrait;

    private static OAttributes\Schema $validationFailedSchema;
    private static OAttributes\Examples $validationFailedExamples;

    #[\Override]
    public function supports(
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): bool {
        return $mapQueryString !== [] || $mapRequestPayload !== [];
    }

    #[\Override]
    public function process(
        OAnnotations\OpenApi $api,
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): OAnnotations\OpenApi {
        $mapToStatusCode = [];

        $mapper = [...$mapRequestPayload, ...$mapQueryString];
        foreach ($mapper as $map) {
            foreach ($map['attributes'] as $attribute) {
                /** @var MapQueryString|MapRequestPayload $instance */
                $instance = $attribute->newInstance();
                $mapToStatusCode[$instance->validationFailedStatusCode] = true;
            }
        }

        foreach (array_keys($mapToStatusCode) as $statusCode) {
            $this->addValidationFailedResponse($operation, $statusCode);
        }

        return $api;
    }

    private function addValidationFailedResponse(OAnnotations\Operation $operation, int|string $statusCode): void
    {
        /** @var OAnnotations\Response $response */
        $response = Util::getIndexedCollectionItem($operation, OAnnotations\Response::class, $statusCode);

        if ($response->description === Generator::UNDEFINED) {
            $response->description = HttpStatusEnum::from($statusCode)->getShortName() . ' response.';
        }

        $jsonContent = $this->getJsonContent($response);

        $jsonContent->oneOf[] = $this->getValidationFailedSchema();
        $jsonContent->examples[] = $this->getValidationFailedExamples();
    }

    private function getValidationFailedSchema(): OAttributes\Schema
    {
        return self::$validationFailedSchema ??= new OAttributes\Schema(
            schema: 'SymfonyMapRequestValidationFailedSchema',
            title: 'Validation Failed Schema for MapQueryString, MapRequestPayload or Symfony Validator',
            description: 'This schema will be used when you will receive a validation error of payload or query string, or any Symfony Validator error.',
            properties: [
                new Property(property: 'status', description: 'The status of the response.', type: 'string', example: 'success'),
                new Property(property: 'error', description: 'The error object.', properties: [
                    new Property(property: 'context_code', description: 'The type of the error.', example: 'API_PROCESSING'),
                    new Property(property: 'parent_code', description: 'A short description of the error.', example: 'VALIDATION'),
                    new Property(property: 'error_code', description: 'A short description of the error.', example: 'VALIDATION_FAILED'),
                    new Property(property: 'status', description: 'The HTTP status code', example: 422),
                    new Property(
                        property: 'violations',
                        description: 'An array of validation errors.',
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
                ]),
            ],
            externalDocs: new OAttributes\ExternalDocumentation(
                description: 'Symfony Validator Component Documentation',
                url: 'https://symfony.com/doc/current/components/validator.html'
            )
        );
    }

    private function getValidationFailedExamples(): OAttributes\Examples
    {
        return self::$validationFailedExamples ??= new OAttributes\Examples(
            example: ApiErrorTypeEnum::VALIDATION_FAILED->value,
            summary: ApiErrorTypeEnum::VALIDATION_FAILED->value,
            description: 'When you will receive a validation error of payload or query string.',
            value: [
                'status' => 'error',
                'error' => [
                    'context_code' => 'API_PROCESSING',
                    'parent_code' => 'VALIDATION',
                    'error_code' => 'VALIDATION_FAILED',
                    'status' => 422,
                    'violations' => [
                        [
                            'propertyPath' => 'email',
                            'code' => 'ERR_VALUE_NOT_VALID_EMAIL',
                            'value' => 'incorrect-at-mail.fr',
                            'message' => 'This value is not a valid email address.',
                        ],
                    ],
                ],
            ]
        );
    }
}

<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use Module\Api\Describer\Trait\JsonContentDescriberProcessTrait;
use Module\Api\Enum\ApiErrorType;
use Module\Api\Enum\HttpStatus;
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
        return \count($mapQueryString) > 0 || \count($mapRequestPayload) > 0;
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

        /** @var array{parameter: \ReflectionParameter, attributes: array<int, \ReflectionAttribute>} $map */
        $mapper = [...$mapRequestPayload, ...$mapQueryString];
        foreach ($mapper as $map) {
            foreach ($map['attributes'] as $attribute) {
                /** @var MapQueryString|MapRequestPayload $instance */
                $instance = $attribute->newInstance();
                $mapToStatusCode[$instance->validationFailedStatusCode] = true;
            }
        }

        foreach ($mapToStatusCode as $statusCode => $value) {
            $this->addValidationFailedResponse($api, $operation, $statusCode);
        }

        return $api;
    }

    private function addValidationFailedResponse(
        mixed $api,
        OAnnotations\Operation $operation,
        int|string $statusCode
    ): void {
        /** @var OAnnotations\Response $response */
        $response = Util::getIndexedCollectionItem($operation, OAnnotations\Response::class, $statusCode);

        if ($response->description === Generator::UNDEFINED) {
            $response->description = HttpStatus::from($statusCode)->getShortName() . ' response.';
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
                new Property(
                    property: 'type',
                    description: 'The type of the error.',
                    example: ApiErrorType::VALIDATION_FAILED->value
                ),
                new Property(
                    property: 'title',
                    description: 'A short description of the error.',
                    example: 'Validation Failed'
                ),
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
            example: ApiErrorType::VALIDATION_FAILED->value,
            summary: ApiErrorType::VALIDATION_FAILED->value,
            description: 'When you will receive a validation error of payload or query string.',
            value: [
                'type' => ApiErrorType::VALIDATION_FAILED->value,
                'title' => 'Validation Failed',
                'status' => 422,
                'violations' => [
                    [
                        'propertyPath' => 'email',
                        'code' => 'ERR_VALUE_NOT_VALID_EMAIL',
                        'value' => 'incorrect-at-mail.fr',
                        'message' => 'This value is not a valid email address.',
                    ],
                ],
            ]
        );
    }
}
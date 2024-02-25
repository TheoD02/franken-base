<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use Module\Api\Describer\Trait\JsonContentDescriberProcessTrait;
use Module\Api\Enum\ApiErrorType;
use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use OpenApi\Annotations as OAnnotations;
use OpenApi\Attributes as OAttributes;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Generator;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Route;

use function dd;

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

        /**
         * @var array{parameter: \ReflectionParameter, attributes: array<int, \ReflectionAttribute>} $map
         */
        $mapper = [...$mapRequestPayload, ...$mapQueryString];
        foreach ($mapper as $map) {
            foreach ($map['attributes'] as $attribute) {
                /**
                 * @var MapQueryString|MapRequestPayload $instance
                 */
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
            $response->description = 'Bad request.';
        }

        $jsonContent = $this->getJsonContent($response);

        $jsonContent->oneOf[] = $this->getValidationFailedSchema();
        $jsonContent->examples[] = $this->getValidationFailedExamples();
    }

    private function getValidationFailedSchema(): OAttributes\Schema
    {
        return self::$validationFailedSchema ??= new OAttributes\Schema(
            schema: 'ValidationErrorSchema',
            title: 'Validation Failed',
            description: 'When you will receive a validation error of payload or query string.',
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
            ]
        );
    }

    private function getValidationFailedExamples(): OAttributes\Examples
    {
        return self::$validationFailedExamples ??= new OAttributes\Examples(
            ApiErrorType::VALIDATION_FAILED->value,
            ApiErrorType::VALIDATION_FAILED->value,
            'When the payload is invalid.',
            [
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

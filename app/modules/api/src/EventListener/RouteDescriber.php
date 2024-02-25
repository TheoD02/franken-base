<?php

declare(strict_types=1);

namespace Module\Api\EventListener;

use Module\Api\AbstractHttpException;
use Module\Api\Attribut\ApiException;
use Module\Api\Enum\ApiErrorType;
use Nelmio\ApiDocBundle\Controller\DocumentationController;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareTrait;
use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use Nelmio\ApiDocBundle\RouteDescriber\RouteDescriberInterface;
use Nelmio\ApiDocBundle\RouteDescriber\RouteDescriberTrait;
use OpenApi\Annotations as OAnnotations;
use OpenApi\Attributes as OAttributes;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Generator;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Route;

class RouteDescriber implements RouteDescriberInterface, ModelRegistryAwareInterface
{
    use ModelRegistryAwareTrait;
    use RouteDescriberTrait;

    private static ?OAttributes\Schema $validationErrorSchema = null;
    private static ?OAttributes\Examples $examples = null;

    private static array $apiExceptions = [];

    #[\Override]
    public function describe(OAnnotations\OpenApi $api, Route $route, \ReflectionMethod $reflectionMethod): void
    {
        if ($reflectionMethod->getDeclaringClass()->getName() === DocumentationController::class) {
            return;
        }

        foreach ($this->getOperations($api, $route) as $operation) {
            if (!$this->hasMapAttributes($reflectionMethod)) {
                return;
            }

            /** @var OAnnotations\Response $response */
            $response = Util::getIndexedCollectionItem($operation, OAnnotations\Response::class, 400);
            /** @var OAttributes\JsonContent|false $jsonContent */
            $jsonContent = current(
                array_filter($response->_unmerged, static fn($item) => $item instanceof OAttributes\JsonContent)
            );
            $context = Util::createContext([
                'nested' => $response,
            ], $response->_context);

            if ($response->description === Generator::UNDEFINED) {
                $response->description = 'Bad request.';
            }

            if ($jsonContent === false) {
                $jsonContent = new OAttributes\JsonContent();
                $jsonContent->description = 'Bad request.';
                $jsonContent->_context = $context;
                $response->_unmerged[] = $jsonContent;
            }

            if ($jsonContent->oneOf === Generator::UNDEFINED) {
                $jsonContent->oneOf = [];
            }

            if (\is_string($jsonContent)) {
                throw new \Exception('What ? JsonContent is a string ?');
            }

            if (self::$validationErrorSchema === null) {
                self::$validationErrorSchema = new OAttributes\Schema(
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
                                    new Property(
                                        property: 'message',
                                        example: 'This value is not a valid email address.'
                                    ),
                                ]
                            ),
                        ),
                    ]
                );
            }

            $jsonContent->oneOf[] = self::$validationErrorSchema;

            if (self::$examples === null) {
                self::$examples = new OAttributes\Examples(
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

            $apiExceptions = $reflectionMethod->getAttributes(ApiException::class, \ReflectionAttribute::IS_INSTANCEOF);
            $apiExemples = [];

            foreach ($apiExceptions as $apiException) {
                /** @var ApiException $apiExceptionInstance */
                $apiExceptionInstance = $apiException->newInstance();

                if (!isset(self::$apiExceptions[$apiExceptionInstance->exceptionFqcn])) {
                    /** @var AbstractHttpException $exceptionInstance */
                    $exceptionInstance = new $apiExceptionInstance->exceptionFqcn();
                    self::$apiExceptions[$apiExceptionInstance->exceptionFqcn] = new OAttributes\Schema(
                        schema: "{$exceptionInstance->getErrorCode()->value}Schema",
                        title: $exceptionInstance->getErrorMessage(),
                        description: $exceptionInstance->describe(),
                        properties: [
                            new Property(
                                property: 'type',
                                description: 'The type of the error.',
                                example: ApiErrorType::BUSINESS_ERROR->value
                            ),
                            new Property(
                                property: 'title',
                                description: 'A short description of the error.',
                                example: 'Business error occurred'
                            ),
                            new Property(
                                property: 'status',
                                description: 'The HTTP status code',
                                example: $exceptionInstance->getStatusCode()
                            ),
                            new Property(
                                property: 'code',
                                description: 'The error code',
                                example: $exceptionInstance->getErrorCode()->value
                            ),
                        ]
                    );

                    $apiExemples[] = new OAttributes\Examples(
                        $exceptionInstance->getErrorCode()->value,
                        $exceptionInstance->getErrorCode()->value,
                        $exceptionInstance->describe(),
                        [
                            'type' => ApiErrorType::BUSINESS_ERROR->value,
                            'title' => $exceptionInstance->getErrorMessage(),
                            'status' => $exceptionInstance->getStatusCode(),
                            'code' => $exceptionInstance->getErrorCode()->value,
                            'debug_message' => $exceptionInstance->describe(),
                        ]
                    );
                }

                $jsonContent->oneOf[] = self::$apiExceptions[$apiExceptionInstance->exceptionFqcn];
            }

            $jsonContent->examples = [self::$examples, ...$apiExemples];
            $jsonContent->validate();
        }
    }

    private function hasMapAttributes(\ReflectionMethod $reflectionMethod): bool
    {
        foreach ($reflectionMethod->getParameters() as $parameter) {
            $attributes = $parameter->getAttributes(MapQueryString::class, \ReflectionAttribute::IS_INSTANCEOF);
            $attributes += $parameter->getAttributes(MapRequestPayload::class, \ReflectionAttribute::IS_INSTANCEOF);

            if (\count($attributes) > 0) {
                return true;
            }
        }

        return false;
    }

    private function addValidationErrorResponse(OAnnotations\OpenApi $api, OAnnotations\Operation $operation): void
    {
        /** @var OAttributes\Response $response */
        $response = Util::getIndexedCollectionItem($operation, OAnnotations\Response::class, 400);
        if ($response->description === Generator::UNDEFINED) {
            $response->description = 'Validation error';
        }

        $mediaType = Util::getCollectionItem($response, OAnnotations\MediaType::class);

        $schema = Util::getChild($mediaType, OAnnotations\Schema::class);
    }
}

<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use Module\Api\Attribut\ApiException;
use Module\Api\Describer\Trait\JsonContentDescriberProcessTrait;
use Module\Api\Enum\HttpStatusEnum;
use Module\ExceptionHandlerBundle\Exception\AbstractHttpException;
use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use OpenApi\Annotations as OAnnotations;
use OpenApi\Attributes as OAttributes;
use OpenApi\Attributes\Property;
use OpenApi\Generator;
use Symfony\Component\Routing\Route;

class BusinessExceptionDescriberProcessor implements DescriberProcessorInterface
{
    use JsonContentDescriberProcessTrait;

    /**
     * @var array<string, OAttributes\Schema>
     */
    private static array $businessExceptionSchema;

    /**
     * @var array<string, OAttributes\Examples>
     */
    private static array $businessExceptionExamples;

    #[\Override]
    public function supports(
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): bool {
        if (class_exists(AbstractHttpException::class) === false) {
            return false;
        }

        return $reflectionMethod->getAttributes(ApiException::class, \ReflectionAttribute::IS_INSTANCEOF) !== [];
    }

    #[\Override]
    public function process(
        OAnnotations\OpenApi $openApi,
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): OAnnotations\OpenApi {
        $apiExceptionsAttributes = $reflectionMethod->getAttributes(ApiException::class, \ReflectionAttribute::IS_INSTANCEOF);

        /** @var array<int, AbstractHttpException> $exceptionByStatusCode */
        $exceptionByStatusCode = [];
        foreach ($apiExceptionsAttributes as $apiExceptionAttribute) {
            /** @var ApiException $attributeInstance */
            $attributeInstance = $apiExceptionAttribute->newInstance();
            /** @var AbstractHttpException $exceptionInstance */
            $exceptionInstance = new $attributeInstance->exceptionFqcn();
            $exceptionByStatusCode[$exceptionInstance->getHttpStatusCode()->value][] = $exceptionInstance;
        }

        foreach ($exceptionByStatusCode as $statusCode => $exceptionList) {
            /** @var OAnnotations\Response $response */
            $response = Util::getIndexedCollectionItem($operation, OAnnotations\Response::class, $statusCode);
            if ($response->description === Generator::UNDEFINED) {
                $response->description = HttpStatusEnum::from($statusCode)->getShortName() . ' response.';
            }

            $jsonContent = $this->getJsonContent($response);
            foreach ($exceptionList as $exception) {
                $jsonContent->oneOf[] = $this->getSchema($exception);
                $jsonContent->examples[] = $this->getExamples($exception);
            }
        }

        return $openApi;
    }

    private function getSchema(AbstractHttpException $httpException): OAttributes\Schema
    {
        return self::$businessExceptionSchema[$httpException::class] ??= new OAttributes\Schema(
            schema: "{$httpException->getErrorCode()->value}Schema",
            title: $httpException->getErrorMessage(),
            description: $httpException->getDescribe(),
            properties: [
                new Property(property: 'status', description: 'The status of the response.', type: 'string', example: 'error'),
                new Property(
                    property: 'error',
                    description: 'The error code.',
                    properties: [
                        new Property(
                            property: 'context_code',
                            description: 'The context code of the error.',
                            type: 'string',
                            example: $httpException->getContextCode()->value
                        ),
                        new Property(
                            property: 'parent_code',
                            description: 'The parent code of the error.',
                            type: 'string',
                            example: $httpException->getParentErrorCode()->value
                        ),
                        new Property(property: 'error_code', description: 'The error code.', type: 'string', example: $httpException->getFormattedErrorCode()),
                        new Property(
                            property: 'status',
                            description: 'The status of the response.',
                            type: 'integer',
                            example: $httpException->getHttpStatusCode()
                        ),
                        new Property(property: 'message', description: 'The message of the error.', type: 'string', example: $httpException->getMessage()),
                        new Property(
                            property: 'debug_message',
                            description: 'The debug message of the error.',
                            type: 'string',
                            example: $httpException->getDescribe()
                        ),
                        new Property(
                            property: 'context',
                            description: 'The context of the error.',
                            type: 'array',
                            items: new OAttributes\Items(
                                description: 'The context of the error. Difficult to describe, it depends on the error.',
                                type: 'string',
                                example: $httpException->getContext()
                            )
                        ),
                    ]
                ),
            ]
        );
    }

    private function getExamples(AbstractHttpException $httpException): OAttributes\Examples
    {
        return self::$businessExceptionExamples[$httpException::class] ??= new OAttributes\Examples(
            $httpException->getErrorCode()->value,
            $httpException->getErrorCode()->value,
            $httpException->getDescribe(),
            [
                'status' => 'error',
                'error' => [
                    'context_code' => $httpException->getContextCode()->value,
                    'parent_code' => $httpException->getParentErrorCode()->value,
                    'error_code' => $httpException->getFormattedErrorCode(),
                    'status' => $httpException->getHttpStatusCode(),
                    'message' => $httpException->getMessage(),
                    'debug_message' => $httpException->getDescribe(),
                    'context' => $httpException->getContext(),
                ],
            ]
        );
    }
}

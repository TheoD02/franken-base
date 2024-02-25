<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use Module\Api\Attribut\ApiException;
use Module\Api\Describer\Trait\JsonContentDescriberProcessTrait;
use Module\Api\Enum\ApiErrorType;
use Module\Api\Enum\HttpStatus;
use Module\Api\Exception\AbstractHttpException;
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
        return \count($reflectionMethod->getAttributes(ApiException::class, \ReflectionAttribute::IS_INSTANCEOF)) > 0;
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
        $apiExceptionsAttributes = $reflectionMethod->getAttributes(
            ApiException::class,
            \ReflectionAttribute::IS_INSTANCEOF
        );

        /** @var array<int, AbstractHttpException> $exceptionByStatusCode */
        $exceptionByStatusCode = [];
        foreach ($apiExceptionsAttributes as $reflectionAttribute) {
            /** @var ApiException $attributeInstance */
            $attributeInstance = $reflectionAttribute->newInstance();
            /** @var AbstractHttpException $exceptionInstance */
            $exceptionInstance = new $attributeInstance->exceptionFqcn();
            $exceptionByStatusCode[$exceptionInstance->getHttpStatusCode()->value][] = $exceptionInstance;
        }

        foreach ($exceptionByStatusCode as $statusCode => $exceptionList) {
            /** @var OAnnotations\Response $response */
            $response = Util::getIndexedCollectionItem($operation, OAnnotations\Response::class, $statusCode);
            if ($response->description === Generator::UNDEFINED) {
                $response->description = HttpStatus::from($statusCode)->getShortName() . ' response.';
            }
            $jsonContent = $this->getJsonContent($response);
            foreach ($exceptionList as $exception) {
                $jsonContent->oneOf[] = $this->getSchema($exception);
                $jsonContent->examples[] = $this->getExamples($exception);
            }
        }

        return $api;
    }

    private function getSchema(AbstractHttpException $exception): OAttributes\Schema
    {
        return self::$businessExceptionSchema[$exception::class] ??= new OAttributes\Schema(
            schema: "{$exception->getErrorCode()->value}Schema",
            title: $exception->getErrorMessage(),
            description: $exception->describe(),
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
                    example: $exception->getHttpStatusCode()
                ),
                new Property(
                    property: 'code',
                    description: 'The error code',
                    example: $exception->getErrorCode()->value
                ),
            ]
        );
    }

    private function getExamples(AbstractHttpException $exception): OAttributes\Examples
    {
        return self::$businessExceptionExamples[$exception::class] ??= new OAttributes\Examples(
            $exception->getErrorCode()->value,
            $exception->getErrorCode()->value,
            $exception->describe(),
            [
                'type' => ApiErrorType::BUSINESS_ERROR->value,
                'title' => $exception->getErrorMessage(),
                'status' => $exception->getHttpStatusCode(),
                'code' => $exception->getErrorCode()->value,
                'debug_message' => $exception->describe(),
            ]
        );
    }
}

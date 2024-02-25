<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Describer\Trait\JsonContentDescriberProcessTrait;
use Module\Api\Enum\ApiErrorType;
use Module\Api\Enum\HttpStatus;
use Module\Api\Enum\ResponseType;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareTrait;
use Nelmio\ApiDocBundle\Model\Model;
use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use OpenApi\Annotations as OAnnotations;
use OpenApi\Annotations\MediaType;
use OpenApi\Annotations\Schema;
use OpenApi\Attributes as OAttributes;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Generator;
use ReflectionMethod;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Routing\Route;

use function class_exists;
use function dd;
use function dump;
use function implode;
use function sprintf;

class OpenApiResponseDescriberProcessor implements DescriberProcessorInterface, ModelRegistryAwareInterface
{
    use JsonContentDescriberProcessTrait;
    use ModelRegistryAwareTrait;

    private static array $responseSchemaList = [];
    private static OAttributes\Schema $schema;

    #[\Override]
    public function supports(
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): bool {
        $openApiResponseAttributes = $reflectionMethod->getAttributes(OpenApiResponse::class);
        return \count($openApiResponseAttributes) > 0;
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
        [$openApiResponseInstance, $openApiMetaInstance] = $this->getAttributesInstance($reflectionMethod);

        $statusCode = $openApiResponseInstance->statusCode->value;
        $responseType = $openApiResponseInstance->type;
        $responseClass = $openApiResponseInstance->class;
        $groups = $openApiResponseInstance->groups;

        /** @var OAnnotations\Response $response */
        $response = Util::getIndexedCollectionItem($operation, OAnnotations\Response::class, $statusCode);

        if ($response->description === Generator::UNDEFINED) {
            $response->description = $openApiResponseInstance->statusCode->getShortName() . ' response.';
        }
        $response->content = [];
        $response->content['application/json'] = new MediaType(['mediaType' => 'application/json']);

        if ($openApiResponseInstance->statusCode === HttpStatus::NO_CONTENT) {
            $response->description = $openApiResponseInstance->statusCode->getShortName();
            return $api;
        }

        /** @var Schema $schema */
        $schema = Util::getChild(
            $response->content['application/json'],
            Schema::class
        );
        $schema->type = 'object';

        $schema->properties = [
            $this->getDataProperty($responseClass, $groups, $responseType),
            $this->getMetaProperty($openApiMetaInstance),
        ];


        return $api;
    }

    private function getOpenApiModel(string $classFqcn, array $groups = []): string
    {
        $model = new Model(
            type: new Type(Type::BUILTIN_TYPE_OBJECT, false, $classFqcn),
            serializationContext: $groups !== [] ? ['groups' => $groups] : [],
        );
        return $this->modelRegistry->register($model);
    }

    private function getDataProperty(string $responseClass, array $groups, ResponseType $responseType): Property
    {
        $dataProperty = new Property(
            property: 'data',
            description: 'The data of the response.',
        );
        $ref = $this->getOpenApiModel($responseClass, $groups);
        if ($responseType === ResponseType::COLLECTION) {
            $dataProperty->type = 'array';
            $dataProperty->items = new Items(
                ref: $ref,
                description: 'The item of the collection.',
                type: 'object',
            );
        } else {
            $dataProperty->type = 'object';
            $dataProperty->ref = $ref;
        }

        return $dataProperty;
    }

    private function getMetaProperty(?OpenApiMeta $openApiMetaInstance): ?Property
    {
        $metaProperty = new Property(
            property: 'meta',
            description: 'The meta of the response.',
            type: 'object',
        );

        if ($openApiMetaInstance === null) {
            $metaProperty->example = null;
            return $metaProperty;
        }

        if ($openApiMetaInstance->class === null) {
            throw new \RuntimeException('The OpenApiMeta attribute must have a class property.');
        }

        if (class_exists($openApiMetaInstance->class) === false) {
            throw new \RuntimeException('The class of the OpenApiMeta attribute does not exist.');
        }


        $metaProperty->type = 'object';
        $metaProperty->ref = $this->getOpenApiModel($openApiMetaInstance->class);

        return $metaProperty;
    }

    /**
     * @param ReflectionMethod $reflectionMethod
     * @return array{OpenApiResponse, OpenApiMeta|null}
     */
    protected function getAttributesInstance(ReflectionMethod $reflectionMethod): array
    {
        $openApiResponseAttributes = $reflectionMethod->getAttributes(OpenApiResponse::class);
        $openApiMetaAttributes = $reflectionMethod->getAttributes(OpenApiMeta::class);

        if (\count($openApiResponseAttributes) > 1) {
            throw new \RuntimeException('An endpoint can only have one OpenApiResponse attribute.');
        }

        if (\count($openApiMetaAttributes) > 1) {
            throw new \RuntimeException('An endpoint can only have one OpenApiMeta attribute.');
        }

        /** @var OpenApiResponse $openApiResponseInstance */
        $openApiResponseInstance = $openApiResponseAttributes[0]->newInstance();

        /** @var ?OpenApiMeta $openApiMetaInstance */
        $openApiMetaInstance = null;
        if (\count($openApiMetaAttributes) > 0) {
            $openApiMetaInstance = $openApiMetaAttributes[0]->newInstance();
        }
        return [$openApiResponseInstance, $openApiMetaInstance];
    }
}

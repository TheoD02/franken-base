<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Describer\Trait\JsonContentDescriberProcessTrait;
use Module\Api\Enum\HttpStatusEnum;
use Module\Api\Enum\ResponseTypeEnum;
use Module\Api\Resolver\ApiResponseAstResolver;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareTrait;
use Nelmio\ApiDocBundle\Model\Model;
use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use OpenApi\Annotations as OAnnotations;
use OpenApi\Annotations\MediaType;
use OpenApi\Annotations\Schema;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Generator;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Routing\Route;

class OpenApiResponseDescriberProcessor implements DescriberProcessorInterface, ModelRegistryAwareInterface
{
    use JsonContentDescriberProcessTrait;
    use ModelRegistryAwareTrait;

    #[\Override]
    public function supports(
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): bool {
        $openApiResponseAttributes = $reflectionMethod->getAttributes(OpenApiResponse::class);

        return $openApiResponseAttributes !== [];
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
        [$httpStatus, $groups] = (new ApiResponseAstResolver())->resolve($reflectionMethod);

        /**
         * @var OpenApiResponse $openApiResponseInstance
         * @var OpenApiMeta|null $openApiMetaInstance
         */
        [$openApiResponseInstance, $openApiMetaInstance] = $this->getAttributesInstance($reflectionMethod);

        $statusCode = $httpStatus->value;
        $responseType = $openApiResponseInstance->responseTypeEnum;
        $responseClass = $openApiResponseInstance->class;

        /** @var OAnnotations\Response $response */
        $response = Util::getIndexedCollectionItem($operation, OAnnotations\Response::class, $statusCode);

        if ($response->description === Generator::UNDEFINED) {
            $response->description = $httpStatus->getShortName() . ' response.';
        }

        $response->content = [];
        $response->content['application/json'] = new MediaType([
            'mediaType' => 'application/json',
        ]);

        if ($httpStatus === HttpStatusEnum::NO_CONTENT) {
            $response->description = $httpStatus->getShortName();

            return $openApi;
        }

        /** @var Schema $schema */
        $schema = Util::getChild($response->content['application/json'], Schema::class);
        $schema->type = 'object';

        $schema->properties = [
            'status' => new Property(property: 'status', description: 'The status of the response.', type: 'string', example: 'success'),
        ];

        if ($responseClass !== null) {
            $schema->properties['data'] = $this->getDataProperty($responseClass, $groups, $responseType);
        }

        $schema->properties['meta'] = $this->getMetaProperty($openApiMetaInstance);

        return $openApi;
    }

    /**
     * @param array<string> $groups
     */
    private function getOpenApiModel(string $classFqcn, array $groups = []): string
    {
        $model = new Model(
            type: new Type(Type::BUILTIN_TYPE_OBJECT, false, $classFqcn),
            serializationContext: $groups !== [] ? [
                'groups' => $groups,
            ] : [],
        );

        return $this->modelRegistry->register($model);
    }

    /**
     * @param array<string> $groups
     */
    private function getDataProperty(string $responseClass, array $groups, ResponseTypeEnum $responseTypeEnum): Property
    {
        $dataProperty = new Property(property: 'data', description: 'The data of the response.');
        $ref = $this->getOpenApiModel($responseClass, $groups);
        if ($responseTypeEnum === ResponseTypeEnum::COLLECTION) {
            $dataProperty->type = 'array';
            $dataProperty->items = new Items(ref: $ref, description: 'The item of the collection.', type: 'object');
        } else {
            $dataProperty->type = 'object';
            $dataProperty->ref = $ref;
        }

        return $dataProperty;
    }

    private function getMetaProperty(?OpenApiMeta $openApiMeta): Property
    {
        $metaProperty = new Property(property: 'meta', description: 'The meta of the response.', type: 'object');

        if (!$openApiMeta instanceof OpenApiMeta) {
            $metaProperty->example = null;

            return $metaProperty;
        }

        if (class_exists($openApiMeta->class) === false) {
            throw new \RuntimeException('The class of the OpenApiMeta attribute does not exist.');
        }

        $metaProperty->type = 'object';
        $metaProperty->ref = $this->getOpenApiModel($openApiMeta->class);

        return $metaProperty;
    }

    /**
     * @return array{OpenApiResponse, OpenApiMeta|null}
     */
    protected function getAttributesInstance(\ReflectionMethod $reflectionMethod): array
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
        if ($openApiMetaAttributes !== []) {
            $openApiMetaInstance = $openApiMetaAttributes[0]->newInstance();
        }

        return [$openApiResponseInstance, $openApiMetaInstance];
    }
}

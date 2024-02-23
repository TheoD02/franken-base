<?php

namespace Module\Api\EventListener;

use loophp\collection\Collection;
use Module\Api\Attribut\BadRequestResponse;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareTrait;
use Nelmio\ApiDocBundle\Model\Model;
use Nelmio\ApiDocBundle\OpenApiPhp\Util;
use Nelmio\ApiDocBundle\RouteDescriber\RouteDescriberInterface;
use Nelmio\ApiDocBundle\RouteDescriber\RouteDescriberTrait;
use OpenApi\Annotations\MediaType;
use OpenApi\Annotations\OpenApi;
use OpenApi\Annotations\Response;
use OpenApi\Annotations\Schema;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use ReflectionProperty;
use RuntimeException;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Routing\Route;

use function count;
use function sprintf;

class RouteDescriber implements RouteDescriberInterface, ModelRegistryAwareInterface
{
    use RouteDescriberTrait;
    use ModelRegistryAwareTrait;

    #[\Override] public function describe(OpenApi $api, Route $route, \ReflectionMethod $reflectionMethod)
    {
        foreach ($this->getOperations($api, $route) as $operation) {
            $this->checkRouteAttributes($reflectionMethod);
            /** @var Response $response */
            $response = Util::getIndexedCollectionItem($operation, Response::class, 'default');
            $response->response = '200';
            $response->description = '';

            $response->content = [];
            $response->content['application/json'] = new MediaType(['mediaType' => 'application/json']);

            /** @var Schema $schema */
            $schema = Util::getChild(
                $response->content['application/json'],
                Schema::class
            );
            $schema->type = 'object';

            /** @var ?OpenApiResponse $openApiResponse */
            $openApiResponse = $this->getAttributeInstance($reflectionMethod, OpenApiResponse::class);
            if ($openApiResponse === null) {
                continue;
            }

            $this->checkOpenApiResponse($openApiResponse, $reflectionMethod);

            $properties[] = $this->getDataProperty($openApiResponse);

            /** @var ?OpenApiMeta $openApiResponse */
            $openApiMeta = $this->getAttributeInstance($reflectionMethod, OpenApiMeta::class);
            $properties[] = $this->getMetaProperty($openApiMeta);

            $schema->properties = $properties;
        }
    }

    /**
     * @template T
     *
     * @param class-string<T> $attributeFqcn
     *
     * @return T
     */
    private function getAttributeInstance(
        \ReflectionMethod|ReflectionProperty $reflectionMethod,
        string $attributeFqcn
    ): ?object {
        $attributes = $reflectionMethod->getAttributes($attributeFqcn);

        if (count($attributes) === 0) {
            return null;
        }

        return $attributes[0]->newInstance();
    }

    protected function getDataProperty(OpenApiResponse $openApiResponse): Property
    {
        $dataModel = $this->getOpenApiModel($openApiResponse->class);


        $dataProperty = new Property(property: 'data', description: 'Data');

        if ($openApiResponse->isCollection()) {
            $dataProperty->type = 'array';
            $dataProperty->items = new Items(ref: $dataModel);
        } else {
            $dataProperty->type = 'object';
            $dataProperty->ref = $dataModel;
        }

        return $dataProperty;
    }

    protected function getMetaProperty(?OpenApiMeta $openApiMeta): Property
    {
        $metaProperty = new Property(property: 'meta', description: 'Meta', type: 'object');
        if ($openApiMeta !== null) {
            $metaModel = $this->getOpenApiModel($openApiMeta->class);
            $metaProperty->ref = $metaModel;
        } else {
            $metaProperty->example = null;
        }
        return $metaProperty;
    }

    private function getOpenApiModel(string $classFqcn): string
    {
        $model = new Model(
            type: new Type(Type::BUILTIN_TYPE_OBJECT, false, $classFqcn)
        );
        return $this->modelRegistry->register($model);
    }

    private function checkOpenApiResponse(OpenApiResponse $openApiResponse, \ReflectionMethod $reflectionMethod): void
    {
        $dataClassReflection = new \ReflectionClass($openApiResponse->class);
        foreach ($dataClassReflection->getProperties() as $property) {
            $openApiPropertyAttributs = $property->getAttributes(Property::class);
            if (count($openApiPropertyAttributs) > 1) {
                throw new RuntimeException(
                    sprintf(
                        'Property "%s" in class "%s" must have only one OpenApi\Attributes\Property attribute.',
                        $property->getName(),
                        $openApiResponse->class
                    )
                );
            }

            $propertyType = $property->getType();
            if ($propertyType === null) {
                throw new RuntimeException(
                    sprintf(
                        'Property "%s" in class "%s" must have a type.',
                        $property->getName(),
                        $openApiResponse->class
                    )
                );
            }

            if ($propertyType->getName() === 'array') {
                throw new RuntimeException(
                    sprintf(
                        'Property "%s" in class "%s" should not use "array" type but use loopphp/collection.',
                        $property->getName(),
                        $openApiResponse->class
                    )
                );
            }

            if ($openApiPropertyAttributs === [] && $propertyType->getName() === Collection::class) {
                throw new RuntimeException(
                    sprintf(
                        'Property "%s" in class "%s" must have an OpenApi\Attributes\Property attribute.',
                        $property->getName(),
                        $openApiResponse->class
                    )
                );
            }

            if ($openApiPropertyAttributs !== [] && $propertyType->getName() === Collection::class) {
                /** @var Property $openApiProperty */
                $openApiProperty = $openApiPropertyAttributs[0]->newInstance();
                // Handle Collection type check
            }
        }
    }

    private function checkRouteAttributes(\ReflectionMethod $reflectionMethod): void
    {
        // Check if has MapQueryString, MapRequestPayload
        $parameters = $reflectionMethod->getParameters();
        $hasMapper = false;

        foreach ($parameters as $parameter) {
            $attributes = $parameter->getAttributes();
            foreach ($attributes as $attribute) {
                if ($attribute->getName() === MapQueryString::class || $attribute->getName(
                    ) === MapRequestPayload::class) {
                    $hasMapper = true;
                    break;
                }
            }
        }

        $hasBadRequestResponseAttribute = $reflectionMethod->getAttributes(BadRequestResponse::class) !== [];

        if ($hasMapper && !$hasBadRequestResponseAttribute) {
            throw new RuntimeException(
                sprintf(
                    'Seems like you forgot to add #[BadRequestResponse] attribute to method "%s" in class "%s". This attribute is required when using #[MapQueryString] or #[MapRequestPayload] attributes.',
                    $reflectionMethod->getName(),
                    $reflectionMethod->getDeclaringClass()->getName()

                )
            );
        }
    }
}
<?php

namespace App\EventListener;

use App\Api\ApiResponse;
use App\Api\SuccessResponse;
use App\User\User;
use loophp\collection\Collection;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareTrait;
use Nelmio\ApiDocBundle\Model\Model;
use Nelmio\ApiDocBundle\RouteDescriber\RouteDescriberInterface;
use Nelmio\ApiDocBundle\RouteDescriber\RouteDescriberTrait;
use OpenApi\Annotations\OpenApi;
use OpenApi\Annotations\PathItem;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\OperationTrait;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Response;
use OpenApi\Generator;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Routing\Route;

use function dd;
use function Symfony\Component\String\u;

class NelmioRouteDescriber implements RouteDescriberInterface, ModelRegistryAwareInterface
{
    use ModelRegistryAwareTrait;
    use RouteDescriberTrait;

    #[\Override]
    public function describe(OpenApi $api, Route $route, \ReflectionMethod $reflectionMethod)
    {
        if (count($route->getMethods()) > 1) {
            throw new \Exception('Multiple methods not supported');
        }

        $pathItemMethod = u($route->getMethods()[0])->lower()->toString();
        $returnType = $reflectionMethod->getReturnType();

        if (null === $returnType) {
            return;
        }

        if ($returnType->getName() !== ApiResponse::class) {
            return;
        }

        $attribute = $reflectionMethod->getAttributes(SuccessResponse::class)[0] ?? null;

        if (null === $attribute) {
            return;
        }

        /** @var SuccessResponse $attributeInstance */
        $attributeInstance = $attribute->newInstance();

        $modelRef = $this->modelRegistry->register(
            new Model(
                type: new Type(Type::BUILTIN_TYPE_OBJECT, false, $attributeInstance->class),
                groups: $attributeInstance->groups !== [] ? $attributeInstance->groups : null,

            )
        );

        /** @var PathItem|null $currentPathItem */
        $currentPathItem = Collection::fromIterable($api->paths)
            ->filter(
                static function ($pathItem) use ($route) {
                    return $pathItem->path === $route->getPath();
                }
            )
            ->first();

        if (null === $currentPathItem) {
            dd('Path not found');
        }

        /** @var OperationTrait|null $operation */
        $operation = Collection::fromIterable($this->getOperations($api, $route))->first();

        if (null === $operation) {
            dd('Operation not found');
        }
        $operation->responses = [
            $this->getApiResponseDoc($attributeInstance),
        ];
    }

    private function getApiResponseDoc(SuccessResponse $successResponse): Response
    {
        $dataModelRef = $this->modelRegistry->register(
            new Model(
                type: new Type(Type::BUILTIN_TYPE_OBJECT, false, User::class),
                groups: $successResponse->groups !== [] ? $successResponse->groups : null,
            )
        );

        $internalJsonContent = new JsonContent(
            title: 'Success',
            description: 'Success',
            properties: [
                new Property(
                    property: 'data',
                    ref: $dataModelRef,
                    type: 'object',
                ),
                new Property(
                    property: 'meta',
                    type: 'object',
                ),
            ]
        );

        return new Response(
            response: 200,
            description: 'Success',
            content: $internalJsonContent,
        );
    }
}


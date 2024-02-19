<?php

namespace App;

use loophp\collection\Collection;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Model\Model;
use Nelmio\ApiDocBundle\Model\ModelRegistry;
use Nelmio\ApiDocBundle\RouteDescriber\RouteDescriberInterface;
use OpenApi\Annotations\OpenApi;
use OpenApi\Attributes\Response;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Routing\Route;

use function array_fill;
use function array_filter;
use function count;
use function dd;
use function dump;
use function Symfony\Component\String\u;

class Describer implements RouteDescriberInterface, ModelRegistryAwareInterface
{
    private ModelRegistry $modelRegistry;

    public function describe(OpenApi $api, Route $route, \ReflectionMethod $reflectionMethod)
    {
        if (count($route->getMethods()) > 1) {
            throw new \RuntimeException('Only one method is allowed for a api route.');
        }

        if ($route->getPath() !== '/api/users') {
            return;
        }

        $httpMethod = u($route->getMethods()[0])->lower()->toString();
        $pathItem = Collection::fromIterable($api->paths)
            ->filter(
                static function ($pathItem) {
                    return $pathItem->path === '/api/users';
                }
            )
            ->first();

        if (null === $pathItem) {
            throw new \RuntimeException('Path not found.');
        }

        $modelRef = $this->modelRegistry->register(
            new Model(
                new Type(Type::BUILTIN_TYPE_OBJECT, false, $reflectionMethod->getReturnType()->getName())
            )
        );
        $pathItem->{$httpMethod}->responses = [new Response(ref: $modelRef, response: 200, description: 'Success')];
    }

    public function setModelRegistry(ModelRegistry $modelRegistry)
    {
        $this->modelRegistry = $modelRegistry;
    }
}
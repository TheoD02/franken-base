<?php

declare(strict_types=1);

namespace Module\Api\Describer;

use Module\Api\Describer\Processor\DescriberProcessorInterface;
use Nelmio\ApiDocBundle\Controller\DocumentationController;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareInterface;
use Nelmio\ApiDocBundle\Describer\ModelRegistryAwareTrait;
use Nelmio\ApiDocBundle\RouteDescriber\RouteDescriberInterface;
use Nelmio\ApiDocBundle\RouteDescriber\RouteDescriberTrait;
use OpenApi\Annotations as OAnnotations;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Route;

class RouteDescriber implements RouteDescriberInterface, ModelRegistryAwareInterface
{
    use ModelRegistryAwareTrait;
    use RouteDescriberTrait;

    /**
     * @param iterable<DescriberProcessorInterface> $processors
     */
    public function __construct(
        #[TaggedIterator(tag: 'module.api.describer.processor')]
        private readonly iterable $processors
    ) {
    }

    #[\Override]
    public function describe(OAnnotations\OpenApi $openApi, Route $route, \ReflectionMethod $reflectionMethod): void
    {
        if ($reflectionMethod->getDeclaringClass()->getName() === DocumentationController::class) {
            return;
        }

        $mapRequestPayload = [];
        $mapQueryString = [];
        foreach ($reflectionMethod->getParameters() as $reflectionParameter) {
            $mapRequestPayloadAttributes = $reflectionParameter->getAttributes(MapRequestPayload::class, \ReflectionAttribute::IS_INSTANCEOF);

            $mapQueryStringAttributes = $reflectionParameter->getAttributes(MapQueryString::class, \ReflectionAttribute::IS_INSTANCEOF);

            if (\count($mapRequestPayloadAttributes) > 0) {
                $mapRequestPayload[] = [
                    'parameter' => $reflectionParameter,
                    'attributes' => $mapRequestPayloadAttributes,
                ];
            }

            if (\count($mapQueryStringAttributes) > 0) {
                $mapQueryString[] = [
                    'parameter' => $reflectionParameter,
                    'attributes' => $mapQueryStringAttributes,
                ];
            }
        }

        if (\count($mapRequestPayload) > 1) {
            throw new \RuntimeException('Only one MapRequestPayload attribute is allowed per method.');
        }

        foreach ($this->getOperations($openApi, $route) as $operation) {
            foreach ($this->processors as $processor) {
                if ($processor->supports($operation, $route, $reflectionMethod, $mapRequestPayload, $mapQueryString)) {
                    if ($processor instanceof ModelRegistryAwareInterface) {
                        $processor->setModelRegistry($this->modelRegistry);
                    }

                    $openApi = $processor->process($openApi, $operation, $route, $reflectionMethod, $mapRequestPayload, $mapQueryString);
                }
            }
        }
    }
}

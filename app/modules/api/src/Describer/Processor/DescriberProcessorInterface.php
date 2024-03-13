<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use OpenApi\Annotations as OAnnotations;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Routing\Route;

#[AutoconfigureTag('module.api.describer.processor')]
interface DescriberProcessorInterface
{
    /**
     * @param array<int, array{parameter: \ReflectionParameter, attributes: array<int, \ReflectionAttribute>}> $mapRequestPayload
     * @param array<int, array{parameter: \ReflectionParameter, attributes: array<int, \ReflectionAttribute>}> $mapQueryString
     */
    public function supports(
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): bool;

    /**
     * @param array<int, array{parameter: \ReflectionParameter, attributes: array<int, \ReflectionAttribute>}> $mapRequestPayload
     * @param array<int, array{parameter: \ReflectionParameter, attributes: array<int, \ReflectionAttribute>}> $mapQueryString
     */
    public function process(
        OAnnotations\OpenApi $openApi,
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): OAnnotations\OpenApi;
}

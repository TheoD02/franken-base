<?php

declare(strict_types=1);

namespace Module\Api\Describer\Processor;

use OpenApi\Annotations as OAnnotations;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Routing\Route;

#[AutoconfigureTag('module.api.describer.processor')]
interface DescriberProcessorInterface
{
    public function supports(
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): bool;

    public function process(
        OAnnotations\OpenApi $api,
        OAnnotations\Operation $operation,
        Route $route,
        \ReflectionMethod $reflectionMethod,
        array $mapRequestPayload,
        array $mapQueryString
    ): OAnnotations\OpenApi;
}

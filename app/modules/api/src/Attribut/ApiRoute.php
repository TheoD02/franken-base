<?php

declare(strict_types=1);

namespace Module\Api\Attribut;

use Module\Api\Enum\HttpMethodEnum;
use Symfony\Component\Routing\Attribute\Route;

use function Symfony\Component\String\u;

/**
 * This is a minimal wrapping of Symfony Route attribute to provide a default name for the route.
 * And it will ensure that endpoint use only one HTTP method.
 *
 * TODO: Possibility to extend HTTP Method to custom one ? Not required yet in our use case.
 */
#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::TARGET_CLASS)]
class ApiRoute extends Route
{
    public function __construct(
        string $path,
        array $requirements = [],
        array $options = [],
        array $defaults = [],
        ?string $host = null,
        HttpMethodEnum $httpMethodEnum = HttpMethodEnum::GET,
        array|string $schemes = [],
        ?string $condition = null,
        ?int $priority = null,
        ?string $locale = null,
        ?string $format = null,
        ?bool $utf8 = null,
        ?bool $stateless = null,
        ?string $env = null
    ) {
        $name = $this->describeNameFromPath($path, $httpMethodEnum);
        parent::__construct(
            $path,
            $name,
            $requirements,
            $options,
            $defaults,
            $host,
            $httpMethodEnum->value,
            $schemes,
            $condition,
            $priority,
            $locale,
            $format,
            $utf8,
            $stateless,
            $env
        );
    }

    private function describeNameFromPath(string $path, HttpMethodEnum $httpMethodEnum): string
    {
        $unicodeString = u($path)
            ->ensureStart('/')
            ->prepend(strtolower($httpMethodEnum->value))
            ->replace('/', '_')
        ;

        return $unicodeString->toString();
    }
}

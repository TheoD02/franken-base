<?php

namespace Module\Api\Attribut;

use Module\Api\Enum\HttpMethod;
use Symfony\Component\Routing\Attribute\Route;

use function strtolower;
use function Symfony\Component\String\u;

#[\Attribute(\Attribute::TARGET_METHOD | \Attribute::TARGET_CLASS)]
class ApiRoute extends Route
{
    public function __construct(
        string $path,
        array $requirements = [],
        array $options = [],
        array $defaults = [],
        ?string $host = null,
        HttpMethod $method = HttpMethod::GET,
        array|string $schemes = [],
        ?string $condition = null,
        ?int $priority = null,
        ?string $locale = null,
        ?string $format = null,
        ?bool $utf8 = null,
        ?bool $stateless = null,
        ?string $env = null
    ) {
        $name = $this->describeNameFromPath($path, $method);
        parent::__construct(
            $path,
            $name,
            $requirements,
            [...$options, ...['test'=> 'coucou']],
            $defaults,
            $host,
            $method->value,
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

    private function describeNameFromPath(string $path, HttpMethod $method): string
    {
        $name = u($path)
            ->ensureStart('/')
            ->prepend(strtolower($method->value))
            ->replace('/', '_');

        return $name->toString();
    }
}
<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Mapper\ObjectMapper;
use Symfony\Component\Mapper\ReflectionMapperMetadataFactory;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AutoMapper
{
    private ObjectMapper $mapper;

    public function __construct()
    {
        $this->mapper = new ObjectMapper(new ReflectionMapperMetadataFactory(), PropertyAccess::createPropertyAccessor());
    }

    /**
     * @template T of object
     *
     * @param class-string<T>|T $targetClass
     *
     * @return T
     */
    public function map(object $source, string|object $targetClass): object
    {
        return $this->mapper->map($source, $targetClass);
    }

    /**
     * @template T
     *
     * @param class-string<T> $targetClass
     *
     * @return array<T>
     */
    public function mapMultiple(iterable $source, string $targetClass): array
    {
        $result = [];
        foreach ($source as $item) {
            $result[] = $this->map($item, $targetClass);
        }

        return $result;
    }
}

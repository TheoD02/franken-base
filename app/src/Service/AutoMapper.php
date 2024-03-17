<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Mapper\ObjectMapper;
use Symfony\Component\Mapper\ReflectionMapperMetadataFactory;
use Symfony\Component\PropertyAccess\PropertyAccess;

class AutoMapper
{
    /**
     * @phpstan-ignore-next-line
     */
    private readonly ObjectMapper $mapper;

    public function __construct()
    {
        $this->mapper = new ObjectMapper(new ReflectionMapperMetadataFactory(), PropertyAccess::createPropertyAccessor());
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $targetClassFqcn
     *
     * @return T
     */
    public function map(object $source, string $targetClassFqcn): object
    {
        /** @var T $object */
        return $this->mapper->map($source, $targetClassFqcn);
    }

    /**
     * @template T of object
     *
     * @param T $targetClass
     *
     * @return T
     */
    public function mapToObject(object $source, object $targetClass): object
    {
        /** @var T $object */
        return $this->mapper->map($source, $targetClass);
    }

    /**
     * @template T
     *
     * @param iterable<object> $source
     * @param class-string<T>  $targetClass
     *
     * @return array<T>
     */
    public function mapMultiple(iterable $source, string $targetClass): array
    {
        /** @var array<T> $result */
        $result = [];
        foreach ($source as $item) {
            /** @var T $object */
            $object = $this->mapper->map($item, $targetClass);
            $result[] = $object;
        }

        return $result;
    }
}

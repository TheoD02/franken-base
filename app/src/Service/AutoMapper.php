<?php

declare(strict_types=1);

namespace App\Service;

use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

class AutoMapper
{
    public function __construct(
        private readonly AutoMapperInterface $autoMapper,
    ) {
    }

    /**
     * @template T
     *
     * @param array<object>        $sourceCollection
     * @param class-string<T>      $targetClass
     * @param array<string, mixed> $context
     *
     * @return array<T>
     */
    public function mapMultiple(array $sourceCollection, string $targetClass, array $context = []): array
    {
        // @phpstan-ignore-next-line
        return $this->autoMapper->mapMultiple($sourceCollection, $targetClass, $context);
    }

    public function getConfiguration(): AutoMapperConfigInterface
    {
        return $this->autoMapper->getConfiguration();
    }

    /**
     * @template T of object
     *
     * @param class-string<T>      $targetClass
     * @param array<string, mixed> $context
     *
     * @return T
     */
    public function map(object $source, string $targetClass, array $context = []): object
    {
        // @phpstan-ignore-next-line
        return $this->autoMapper->map($source, $targetClass, $context);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function mapToObject(object $source, object $destination, array $context = []): object
    {
        // @phpstan-ignore-next-line
        return $this->autoMapper->mapToObject($source, $destination, $context);
    }
}

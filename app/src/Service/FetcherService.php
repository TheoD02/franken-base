<?php

namespace App\Service;

use App\Attribute\LazyFetchResource;
use Module\Api\Adapter\FetcheableInterface;
use Module\Api\ValueObject\Identifier;
use Symfony\Component\HttpKernel\KernelInterface;

class FetcherService
{
    public function __construct(
        private readonly KernelInterface $kernel,
    ) {
    }

    public function fetchRemoteResourceFor(object $object): void
    {
        $reflection = new \ReflectionClass($object);

        foreach ($reflection->getProperties() as $property) {
            if ($property->isInitialized($object) === false) {
                $class = $property->getType()?->getName();
                if ($class === null) {
                    continue;
                }
                $property->setValue($object, new $class());
                continue;
            }

            $attributes = $property->getAttributes(LazyFetchResource::class);

            if (count($attributes) === 0) {
                continue;
            }

            /** @var LazyFetchResource $attributeInstance */
            $attributeInstance = $attributes[0]->newInstance();

            $collectionFqcn = $attributeInstance->collectionFqcn;
            $collectionReflection = new \ReflectionClass($collectionFqcn);

            $serviceInstances = [];
            foreach ($collectionReflection->getConstructor()?->getParameters() ?? [] as $parameter) {
                $serviceInstances[] = $this->kernel->getContainer()->get($parameter->getType()?->getName());
            }

            $collectionInstance = new $collectionFqcn(...$serviceInstances);

            if ($collectionInstance instanceof FetcheableInterface === false) {
                continue;
            }

            $ids = array_map(static fn(Identifier $identifier) => $identifier->identifier, $property->getValue($object)->toArray());
            $existing = $collectionReflection->getStaticPropertyValue('globalIdentifiers', []);
            $collectionReflection->setStaticPropertyValue('globalIdentifiers', array_merge($existing, $ids));
            $collectionInstance->setIdentifiers(array_unique($ids));
            $property->setValue($object, $collectionInstance);
        }
    }
}
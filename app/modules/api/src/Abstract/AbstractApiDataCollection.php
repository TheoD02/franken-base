<?php

declare(strict_types=1);

namespace Module\Api\Abstract;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\Adapter\ApiMetadataInterface;
use Rekalogika\Collections\Decorator\Decorator\SelectableCollectionDecorator;
use Rekalogika\Mapper\CollectionInterface;

/**
 * @template TKey of int
 * @template T
 *
 * @extends SelectableCollectionDecorator<TKey, T>
 * @implements CollectionInterface<TKey, T>
 */
abstract class AbstractApiDataCollection extends SelectableCollectionDecorator implements ApiDataCollectionInterface, CollectionInterface
{
    /**
     * @see AbstractApiDataCollection::empty for an empty collection
     * @see AbstractApiDataCollection::fromArray for a collection with items
     */
    public function __construct(
        Collection $wrapped = new ArrayCollection()
    ) {
        parent::__construct($wrapped);
    }

    abstract public function getMeta(): ApiMetadataInterface;

    public static function empty(): static
    {
        // @phpstan-ignore-next-line
        return new static();
    }

    /**
     * @param array<TKey, T> $items
     */
    public static function fromArray(array $items): static
    {
        // @phpstan-ignore-next-line
        return new static(new ArrayCollection($items));
    }
}

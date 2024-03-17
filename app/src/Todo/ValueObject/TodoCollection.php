<?php

declare(strict_types=1);

namespace App\Todo\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;
use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\ValueObject\GenericCollectionMetadata;

/**
 * @template TKey of array-key
 * @template T of Todo
 *
 * @implements ApiDataCollectionInterface<TKey, T>
 *
 * @extends ArrayCollection<TKey, T>
 */
class TodoCollection extends ArrayCollection implements ApiDataCollectionInterface
{
    #[\Override]
    public function getMeta(): GenericCollectionMetadata
    {
        return new GenericCollectionMetadata(total: $this->count(), page: 1, limit: $this->count());
    }
}

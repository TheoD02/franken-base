<?php

declare(strict_types=1);

namespace App\User\ValueObject;

use App\User\Api\UserCollectionMeta;
use App\User\Entity\UserEntity;
use loophp\collection\CollectionDecorator;
use Module\Api\Adapter\ApiDataCollectionInterface;

/**
 * @extends CollectionDecorator<array-key, UserEntity>
 */
class UserCollection extends CollectionDecorator implements ApiDataCollectionInterface, \Countable
{
    #[\Override]
    public function getMeta(): UserCollectionMeta
    {
        return new UserCollectionMeta(total: $this->count(), page: 1, limit: 10);
    }

    #[\Override]
    public function count(): int
    {
        return iterator_count($this->getIterator());
    }
}

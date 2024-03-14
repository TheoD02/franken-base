<?php

declare(strict_types=1);

namespace App\User;

use App\Entity\User;
use App\User\Api\UserCollectionMeta;
use loophp\collection\CollectionDecorator;
use Module\Api\Adapter\ApiDataCollectionInterface;

/**
 * @extends CollectionDecorator<array-key, User>
 */
class UserCollection extends CollectionDecorator implements ApiDataCollectionInterface, \Countable
{
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

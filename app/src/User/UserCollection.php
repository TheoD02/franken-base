<?php

declare(strict_types=1);

namespace App\User;

use App\Entity\User;
use App\User\Api\UserCollectionMeta;
use Countable;
use loophp\collection\CollectionDecorator;
use Module\Api\Adapter\ApiDataCollectionInterface;

use function iterator_count;

/**
 * @extends CollectionDecorator<mixed, User>
 */
class UserCollection extends CollectionDecorator implements ApiDataCollectionInterface, Countable
{
    public function getMeta(): UserCollectionMeta
    {
        return new UserCollectionMeta(
            total: $this->count(),
            page: 1,
            limit: 10
        );
    }

    #[\Override]
    public function count(): int
    {
        return iterator_count($this->getIterator());
    }
}

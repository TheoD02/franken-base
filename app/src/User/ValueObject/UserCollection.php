<?php

declare(strict_types=1);

namespace App\User\ValueObject;

use App\User\Api\UserCollectionMeta;
use Doctrine\Common\Collections\ArrayCollection;
use Module\Api\Adapter\ApiDataCollectionInterface;

/**
 * @extends ArrayCollection<array-key, User>
 */
class UserCollection extends ArrayCollection implements ApiDataCollectionInterface
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

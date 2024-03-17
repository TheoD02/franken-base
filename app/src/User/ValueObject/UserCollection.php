<?php

declare(strict_types=1);

namespace App\User\ValueObject;

use Doctrine\Common\Collections\ArrayCollection;
use Module\Api\Adapter\ApiDataCollectionInterface;

/**
 * @template TKey of array-key
 * @template T of User
 *
 * @implements ApiDataCollectionInterface<TKey, T>
 *
 * @extends ArrayCollection<TKey, T>
 */
class UserCollection extends ArrayCollection implements ApiDataCollectionInterface
{
    #[\Override]
    public function getMeta(): UserCollectionMeta
    {
        return new UserCollectionMeta(total: $this->count(), page: 1, limit: 10);
    }
}

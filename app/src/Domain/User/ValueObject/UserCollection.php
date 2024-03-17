<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use Module\Api\Abstract\AbstractApiDataCollection;

/**
 * @extends AbstractApiDataCollection<int, User>
 */
class UserCollection extends AbstractApiDataCollection
{
    #[\Override]
    public function getMeta(): UserCollectionMeta
    {
        return new UserCollectionMeta(total: $this->count(), page: 1, limit: 10);
    }
}

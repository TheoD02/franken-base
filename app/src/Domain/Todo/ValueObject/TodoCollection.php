<?php

declare(strict_types=1);

namespace App\Domain\Todo\ValueObject;

use Module\Api\Abstract\AbstractApiDataCollection;
use Module\Api\ValueObject\GenericCollectionMetadata;

/**
 * @extends AbstractApiDataCollection<int, Todo>
 */
class TodoCollection extends AbstractApiDataCollection
{
    #[\Override]
    public function getMeta(): GenericCollectionMetadata
    {
        return new GenericCollectionMetadata(total: $this->count(), page: 1, limit: $this->count());
    }
}

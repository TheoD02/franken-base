<?php

declare(strict_types=1);

namespace Module\Api\Adapter;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;

/**
 * Use this interface to mark a class as valid to be used as a response data collection.
 *
 * @template TKey of array-key
 * @template T
 *
 * @template-extends Collection<TKey, T>
 * @template-extends Selectable<TKey, T>
 */
interface ApiDataCollectionInterface extends ApiMetadataInterface, Collection, Selectable, \Stringable
{
    /**
     * Get the metadata for the collection.
     */
    public function getMeta(): ApiMetadataInterface;
}

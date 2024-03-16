<?php

declare(strict_types=1);

namespace Module\Api\Adapter;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;

/**
 * Use this interface to mark a class as valid to be used as a response data collection.
 *
 * @template-extends ArrayCollection<array-key, object>
 */
interface ApiDataCollectionInterface extends ApiMetadataInterface, Collection, Selectable, \Stringable
{
    /**
     * Get the meta data for the collection.
     */
    public function getMeta(): ApiMetadataInterface;
}

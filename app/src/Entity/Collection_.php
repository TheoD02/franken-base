<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * A collection of items, e.g. creative works or products.
 *
 * @see https://schema.org/Collection
 */
#[ORM\MappedSuperclass]
abstract class Collection_ extends CreativeWork
{
    /**
     * The number of items in the \[\[Collection\]\].
     *
     * @see https://schema.org/collectionSize
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/collectionSize'])]
    private ?int $collectionSize = null;

    public function setCollectionSize(?int $collectionSize): void
    {
        $this->collectionSize = $collectionSize;
    }

    public function getCollectionSize(): ?int
    {
        return $this->collectionSize;
    }
}

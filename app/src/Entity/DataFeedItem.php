<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A single item within a larger data feed.
 *
 * @see https://schema.org/DataFeedItem
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DataFeedItem'])]
class DataFeedItem extends Intangible
{
    /**
     * The date on which the CreativeWork was most recently modified or when the item's entry was modified within a DataFeed.
     *
     * @see https://schema.org/dateModified
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/dateModified'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $dateModified = null;

    /**
     * The datetime the item was removed from the DataFeed.
     *
     * @see https://schema.org/dateDeleted
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/dateDeleted'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $dateDeleted = null;

    /**
     * The date on which the CreativeWork was created or the item was added to a DataFeed.
     *
     * @see https://schema.org/dateCreated
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/dateCreated'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $dateCreated = null;

    /**
     * An entity represented by an entry in a list or data feed (e.g. an 'artist' in a list of 'artists').
     *
     * @see https://schema.org/item
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/item'])]
    #[Assert\NotNull]
    private Thing $item;

    public function setDateModified(?\DateTimeInterface $dateModified): void
    {
        $this->dateModified = $dateModified;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateDeleted(?\DateTimeInterface $dateDeleted): void
    {
        $this->dateDeleted = $dateDeleted;
    }

    public function getDateDeleted(): ?\DateTimeInterface
    {
        return $this->dateDeleted;
    }

    public function setDateCreated(?\DateTimeInterface $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setItem(Thing $item): void
    {
        $this->item = $item;
    }

    public function getItem(): Thing
    {
        return $this->item;
    }
}

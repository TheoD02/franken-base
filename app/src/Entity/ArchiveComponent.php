<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An intangible type to be applied to any archive content, carrying with it a set of properties required to describe archival items and collections.
 *
 * @see https://schema.org/ArchiveComponent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ArchiveComponent'])]
class ArchiveComponent extends CreativeWork
{
    /**
     * Current location of the item.
     *
     * @see https://schema.org/itemLocation
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/itemLocation'])]
    private ?string $itemLocation = null;

    /**
     * \[\[ArchiveOrganization\]\] that holds, keeps or maintains the \[\[ArchiveComponent\]\].
     *
     * @see https://schema.org/holdingArchive
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ArchiveOrganization')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/holdingArchive'])]
    #[Assert\NotNull]
    private ArchiveOrganization $holdingArchive;

    public function setItemLocation(?string $itemLocation): void
    {
        $this->itemLocation = $itemLocation;
    }

    public function getItemLocation(): ?string
    {
        return $this->itemLocation;
    }

    public function setHoldingArchive(ArchiveOrganization $holdingArchive): void
    {
        $this->holdingArchive = $holdingArchive;
    }

    public function getHoldingArchive(): ArchiveOrganization
    {
        return $this->holdingArchive;
    }
}

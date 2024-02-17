<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Represents the collection of all sports organizations, including sports teams, governing bodies, and sports associations.
 *
 * @see https://schema.org/SportsOrganization
 */
#[ORM\MappedSuperclass]
abstract class SportsOrganization extends Organization
{
    /**
     * A type of sport (e.g. Baseball).
     *
     * @see https://schema.org/sport
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/sport'])]
    private ?string $sport = null;

    public function setSport(?string $sport): void
    {
        $this->sport = $sport;
    }

    public function getSport(): ?string
    {
        return $this->sport;
    }
}

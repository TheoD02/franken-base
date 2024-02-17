<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A PerformanceRole is a Role that some entity places with regard to a theatrical performance, e.g. in a Movie, TVSeries etc.
 *
 * @see https://schema.org/PerformanceRole
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PerformanceRole'])]
class PerformanceRole extends Role
{
    /**
     * The name of a character played in some acting or performing role, i.e. in a PerformanceRole.
     *
     * @see https://schema.org/characterName
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/characterName'])]
    private ?string $characterName = null;

    public function setCharacterName(?string $characterName): void
    {
        $this->characterName = $characterName;
    }

    public function getCharacterName(): ?string
    {
        return $this->characterName;
    }
}

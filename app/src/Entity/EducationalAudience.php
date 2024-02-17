<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An EducationalAudience.
 *
 * @see https://schema.org/EducationalAudience
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EducationalAudience'])]
class EducationalAudience extends Audience
{
    /**
     * An educationalRole of an EducationalAudience.
     *
     * @see https://schema.org/educationalRole
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/educationalRole'])]
    private ?string $educationalRole = null;

    public function setEducationalRole(?string $educationalRole): void
    {
        $this->educationalRole = $educationalRole;
    }

    public function getEducationalRole(): ?string
    {
        return $this->educationalRole;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The legal availability status of a medical drug.
 *
 * @see https://schema.org/DrugLegalStatus
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DrugLegalStatus'])]
class DrugLegalStatus extends MedicalIntangible
{
    /**
     * The location in which the status applies.
     *
     * @see https://schema.org/applicableLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
    #[ApiProperty(types: ['https://schema.org/applicableLocation'])]
    private ?AdministrativeArea $applicableLocation = null;

    public function setApplicableLocation(?AdministrativeArea $applicableLocation): void
    {
        $this->applicableLocation = $applicableLocation;
    }

    public function getApplicableLocation(): ?AdministrativeArea
    {
        return $this->applicableLocation;
    }
}

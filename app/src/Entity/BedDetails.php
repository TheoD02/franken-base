<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An entity holding detailed information about the available bed types, e.g. the quantity of twin beds for a hotel room. For the single case of just one bed of a certain type, you can use bed directly with a text. See also \[\[BedType\]\] (under development).
 *
 * @see https://schema.org/BedDetails
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BedDetails'])]
class BedDetails extends Intangible
{
    /**
     * The type of bed to which the BedDetail refers, i.e. the type of bed available in the quantity indicated by quantity.
     *
     * @see https://schema.org/typeOfBed
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/typeOfBed'])]
    private ?string $typeOfBed = null;

    /**
     * The quantity of the given bed type available in the HotelRoom, Suite, House, or Apartment.
     *
     * @see https://schema.org/numberOfBeds
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/numberOfBeds'])]
    private ?string $numberOfBeds = null;

    public function setTypeOfBed(?string $typeOfBed): void
    {
        $this->typeOfBed = $typeOfBed;
    }

    public function getTypeOfBed(): ?string
    {
        return $this->typeOfBed;
    }

    public function setNumberOfBeds(?string $numberOfBeds): void
    {
        $this->numberOfBeds = $numberOfBeds;
    }

    public function getNumberOfBeds(): ?string
    {
        return $this->numberOfBeds;
    }
}

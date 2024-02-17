<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * A bus (also omnibus or autobus) is a road vehicle designed to carry passengers. Coaches are luxury busses, usually in service for long distance travel.
 *
 * @see https://schema.org/BusOrCoach
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BusOrCoach'])]
class BusOrCoach extends Vehicle
{
    /**
     * @var Collection<QuantitativeValue>|null The permitted total weight of cargo and installations (e.g. a roof rack) on top of the vehicle.\\n\\nTypical unit code(s): KGM for kilogram, LBR for pound\\n\\n\* Note 1: You can indicate additional information in the \[\[name\]\] of the \[\[QuantitativeValue\]\] node.\\n\* Note 2: You may also link to a \[\[QualitativeValue\]\] node that provides additional information using \[\[valueReference\]\]\\n\* Note 3: Note that you can use \[\[minValue\]\] and \[\[maxValue\]\] to indicate ranges.
     *
     * @see https://schema.org/roofLoad
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'bus_or_coach_quantitative_value_roof_load')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/roofLoad'])]
    private ?Collection $roofLoad = null;

    /**
     * The ACRISS Car Classification Code is a code used by many car rental companies, for classifying vehicles. ACRISS stands for Association of Car Rental Industry Systems and Standards.
     *
     * @see https://schema.org/acrissCode
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/acrissCode'])]
    private ?string $acrissCode = null;

    public function __construct()
    {
        parent::__construct();
        $this->roofLoad = new ArrayCollection();
    }

    public function addRoofLoad(QuantitativeValue $roofLoad): void
    {
        $this->roofLoad[] = $roofLoad;
    }

    public function removeRoofLoad(QuantitativeValue $roofLoad): void
    {
        $this->roofLoad->removeElement($roofLoad);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getRoofLoad(): Collection
    {
        return $this->roofLoad;
    }

    public function setAcrissCode(?string $acrissCode): void
    {
        $this->acrissCode = $acrissCode;
    }

    public function getAcrissCode(): ?string
    {
        return $this->acrissCode;
    }
}

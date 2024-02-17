<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * A specific dosing schedule for a drug or supplement.
 *
 * @see https://schema.org/DoseSchedule
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'doseSchedule' => DoseSchedule::class,
    'reportedDoseSchedule' => ReportedDoseSchedule::class,
    'maximumDoseSchedule' => MaximumDoseSchedule::class,
    'recommendedDoseSchedule' => RecommendedDoseSchedule::class,
])]
class DoseSchedule extends MedicalIntangible
{
    /**
     * The unit of the dose, e.g. 'mg'.
     *
     * @see https://schema.org/doseUnit
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/doseUnit'])]
    private ?string $doseUnit = null;

    /**
     * Characteristics of the population for which this is intended, or which typically uses it, e.g. 'adults'.
     *
     * @see https://schema.org/targetPopulation
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/targetPopulation'])]
    private ?string $targetPopulation = null;

    /**
     * How often the dose is taken, e.g. 'daily'.
     *
     * @see https://schema.org/frequency
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/frequency'])]
    private ?string $frequency = null;

    /**
     * The value of the dose, e.g. 500.
     *
     * @see https://schema.org/doseValue
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/doseValue'])]
    private ?string $doseValue = null;

    public function setDoseUnit(?string $doseUnit): void
    {
        $this->doseUnit = $doseUnit;
    }

    public function getDoseUnit(): ?string
    {
        return $this->doseUnit;
    }

    public function setTargetPopulation(?string $targetPopulation): void
    {
        $this->targetPopulation = $targetPopulation;
    }

    public function getTargetPopulation(): ?string
    {
        return $this->targetPopulation;
    }

    public function setFrequency(?string $frequency): void
    {
        $this->frequency = $frequency;
    }

    public function getFrequency(): ?string
    {
        return $this->frequency;
    }

    public function setDoseValue(?string $doseValue): void
    {
        $this->doseValue = $doseValue;
    }

    public function getDoseValue(): ?string
    {
        return $this->doseValue;
    }
}

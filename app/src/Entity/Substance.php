<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any matter of defined composition that has discrete existence, whose origin may be biological, mineral or chemical.
 *
 * @see https://schema.org/Substance
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Substance'])]
class Substance extends MedicalEntity
{
    /**
     * An active ingredient, typically chemical compounds and/or biologic substances.
     *
     * @see https://schema.org/activeIngredient
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/activeIngredient'])]
    private ?string $activeIngredient = null;

    /**
     * Recommended intake of this supplement for a given population as defined by a specific recommending authority.
     *
     * @see https://schema.org/maximumIntake
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MaximumDoseSchedule')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/maximumIntake'])]
    #[Assert\NotNull]
    private MaximumDoseSchedule $maximumIntake;

    public function setActiveIngredient(?string $activeIngredient): void
    {
        $this->activeIngredient = $activeIngredient;
    }

    public function getActiveIngredient(): ?string
    {
        return $this->activeIngredient;
    }

    public function setMaximumIntake(MaximumDoseSchedule $maximumIntake): void
    {
        $this->maximumIntake = $maximumIntake;
    }

    public function getMaximumIntake(): MaximumDoseSchedule
    {
        return $this->maximumIntake;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A medical procedure intended primarily for therapeutic purposes, aimed at improving a health condition.
 *
 * @see https://schema.org/TherapeuticProcedure
 */
#[ORM\MappedSuperclass]
abstract class TherapeuticProcedure extends MedicalProcedure
{
    /**
     * A dosing schedule for the drug for a given population, either observed, recommended, or maximum dose based on the type used.
     *
     * @see https://schema.org/doseSchedule
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DoseSchedule')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/doseSchedule'])]
    #[Assert\NotNull]
    private DoseSchedule $doseSchedule;

    /**
     * Specifying a drug or medicine used in a medication procedure.
     *
     * @see https://schema.org/drug
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Drug')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/drug'])]
    #[Assert\NotNull]
    private Drug $drug;

    /**
     * A possible complication and/or side effect of this therapy. If it is known that an adverse outcome is serious (resulting in death, disability, or permanent damage; requiring hospitalization; or otherwise life-threatening or requiring immediate medical attention), tag it as a seriousAdverseOutcome instead.
     *
     * @see https://schema.org/adverseOutcome
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/adverseOutcome'])]
    #[Assert\NotNull]
    private MedicalEntity $adverseOutcome;

    public function setDoseSchedule(DoseSchedule $doseSchedule): void
    {
        $this->doseSchedule = $doseSchedule;
    }

    public function getDoseSchedule(): DoseSchedule
    {
        return $this->doseSchedule;
    }

    public function setDrug(Drug $drug): void
    {
        $this->drug = $drug;
    }

    public function getDrug(): Drug
    {
        return $this->drug;
    }

    public function setAdverseOutcome(MedicalEntity $adverseOutcome): void
    {
        $this->adverseOutcome = $adverseOutcome;
    }

    public function getAdverseOutcome(): MedicalEntity
    {
        return $this->adverseOutcome;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\MedicalProcedureType;
use App\Enum\MedicalStudyStatus;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A process of care used in either a diagnostic, therapeutic, preventive or palliative capacity that relies on invasive (surgical), non-invasive, or other techniques.
 *
 * @see https://schema.org/MedicalProcedure
 */
#[ORM\MappedSuperclass]
abstract class MedicalProcedure extends MedicalEntity
{
    /**
     * Location in the body of the anatomical structure.
     *
     * @see https://schema.org/bodyLocation
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/bodyLocation'])]
    private ?string $bodyLocation = null;

    /**
     * How the procedure is performed.
     *
     * @see https://schema.org/howPerformed
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/howPerformed'])]
    private ?string $howPerformed = null;

    /**
     * Typical or recommended followup care after the procedure is performed.
     *
     * @see https://schema.org/followup
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/followup'])]
    private ?string $followup = null;

    /**
     * The status of the study (enumerated).
     *
     * @see https://schema.org/status
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/status'])]
    #[Assert\Choice(callback: [MedicalStudyStatus::class, 'toArray'])]
    private ?string $status = null;

    /**
     * The type of procedure, for example Surgical, Noninvasive, or Percutaneous.
     *
     * @see https://schema.org/procedureType
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/procedureType'])]
    #[Assert\Choice(callback: [MedicalProcedureType::class, 'toArray'])]
    private ?string $procedureType = null;

    /**
     * Typical preparation that a patient must undergo before having the procedure performed.
     *
     * @see https://schema.org/preparation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/preparation'])]
    #[Assert\NotNull]
    private MedicalEntity $preparation;

    public function setBodyLocation(?string $bodyLocation): void
    {
        $this->bodyLocation = $bodyLocation;
    }

    public function getBodyLocation(): ?string
    {
        return $this->bodyLocation;
    }

    public function setHowPerformed(?string $howPerformed): void
    {
        $this->howPerformed = $howPerformed;
    }

    public function getHowPerformed(): ?string
    {
        return $this->howPerformed;
    }

    public function setFollowup(?string $followup): void
    {
        $this->followup = $followup;
    }

    public function getFollowup(): ?string
    {
        return $this->followup;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setProcedureType(?string $procedureType): void
    {
        $this->procedureType = $procedureType;
    }

    public function getProcedureType(): ?string
    {
        return $this->procedureType;
    }

    public function setPreparation(MedicalEntity $preparation): void
    {
        $this->preparation = $preparation;
    }

    public function getPreparation(): MedicalEntity
    {
        return $this->preparation;
    }
}

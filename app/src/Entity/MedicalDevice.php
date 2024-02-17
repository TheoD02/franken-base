<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any object used in a medical capacity, such as to diagnose or treat a patient.
 *
 * @see https://schema.org/MedicalDevice
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalDevice'])]
class MedicalDevice extends MedicalEntity
{
    /**
     * A contraindication for this therapy.
     *
     * @see https://schema.org/contraindication
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/contraindication'])]
    private ?string $contraindication = null;

    /**
     * A description of the postoperative procedures, care, and/or followups for this device.
     *
     * @see https://schema.org/postOp
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/postOp'])]
    private ?string $postOp = null;

    /**
     * A possible serious complication and/or serious side effect of this therapy. Serious adverse outcomes include those that are life-threatening; result in death, disability, or permanent damage; require hospitalization or prolong existing hospitalization; cause congenital anomalies or birth defects; or jeopardize the patient and may require medical or surgical intervention to prevent one of the outcomes in this definition.
     *
     * @see https://schema.org/seriousAdverseOutcome
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/seriousAdverseOutcome'])]
    #[Assert\NotNull]
    private MedicalEntity $seriousAdverseOutcome;

    /**
     * A description of the workup, testing, and other preparations required before implanting this device.
     *
     * @see https://schema.org/preOp
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/preOp'])]
    private ?string $preOp = null;

    /**
     * A description of the procedure involved in setting up, using, and/or installing the device.
     *
     * @see https://schema.org/procedure
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/procedure'])]
    private ?string $procedure = null;

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

    public function setContraindication(?string $contraindication): void
    {
        $this->contraindication = $contraindication;
    }

    public function getContraindication(): ?string
    {
        return $this->contraindication;
    }

    public function setPostOp(?string $postOp): void
    {
        $this->postOp = $postOp;
    }

    public function getPostOp(): ?string
    {
        return $this->postOp;
    }

    public function setSeriousAdverseOutcome(MedicalEntity $seriousAdverseOutcome): void
    {
        $this->seriousAdverseOutcome = $seriousAdverseOutcome;
    }

    public function getSeriousAdverseOutcome(): MedicalEntity
    {
        return $this->seriousAdverseOutcome;
    }

    public function setPreOp(?string $preOp): void
    {
        $this->preOp = $preOp;
    }

    public function getPreOp(): ?string
    {
        return $this->preOp;
    }

    public function setProcedure(?string $procedure): void
    {
        $this->procedure = $procedure;
    }

    public function getProcedure(): ?string
    {
        return $this->procedure;
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

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A stage of a medical condition, such as 'Stage IIIa'.
 *
 * @see https://schema.org/MedicalConditionStage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalConditionStage'])]
class MedicalConditionStage extends MedicalIntangible
{
    /**
     * The stage represented as a number, e.g. 3.
     *
     * @see https://schema.org/stageAsNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/stageAsNumber'])]
    private ?string $stageAsNumber = null;

    /**
     * The substage, e.g. 'a' for Stage IIIa.
     *
     * @see https://schema.org/subStageSuffix
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/subStageSuffix'])]
    private ?string $subStageSuffix = null;

    public function setStageAsNumber(?string $stageAsNumber): void
    {
        $this->stageAsNumber = $stageAsNumber;
    }

    public function getStageAsNumber(): ?string
    {
        return $this->stageAsNumber;
    }

    public function setSubStageSuffix(?string $subStageSuffix): void
    {
        $this->subStageSuffix = $subStageSuffix;
    }

    public function getSubStageSuffix(): ?string
    {
        return $this->subStageSuffix;
    }
}

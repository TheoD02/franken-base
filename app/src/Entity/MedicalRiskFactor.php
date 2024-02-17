<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A risk factor is anything that increases a person's likelihood of developing or contracting a disease, medical condition, or complication.
 *
 * @see https://schema.org/MedicalRiskFactor
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalRiskFactor'])]
class MedicalRiskFactor extends MedicalEntity
{
    /**
     * The condition, complication, etc. influenced by this factor.
     *
     * @see https://schema.org/increasesRiskOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
    #[ApiProperty(types: ['https://schema.org/increasesRiskOf'])]
    private ?MedicalEntity $increasesRiskOf = null;

    public function setIncreasesRiskOf(?MedicalEntity $increasesRiskOf): void
    {
        $this->increasesRiskOf = $increasesRiskOf;
    }

    public function getIncreasesRiskOf(): ?MedicalEntity
    {
        return $this->increasesRiskOf;
    }
}

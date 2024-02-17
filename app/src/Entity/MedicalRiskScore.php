<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A simple system that adds up the number of risk factors to yield a score that is associated with prognosis, e.g. CHAD score, TIMI risk score.
 *
 * @see https://schema.org/MedicalRiskScore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalRiskScore'])]
class MedicalRiskScore extends MedicalRiskEstimator
{
    /**
     * The algorithm or rules to follow to compute the score.
     *
     * @see https://schema.org/algorithm
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/algorithm'])]
    private ?string $algorithm = null;

    public function setAlgorithm(?string $algorithm): void
    {
        $this->algorithm = $algorithm;
    }

    public function getAlgorithm(): ?string
    {
        return $this->algorithm;
    }
}

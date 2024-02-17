<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A guideline recommendation that is regarded as efficacious and where quality of the data supporting the recommendation is sound.
 *
 * @see https://schema.org/MedicalGuidelineRecommendation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalGuidelineRecommendation'])]
class MedicalGuidelineRecommendation extends MedicalGuideline
{
    /**
     * Strength of the guideline's recommendation (e.g. 'class I').
     *
     * @see https://schema.org/recommendationStrength
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/recommendationStrength'])]
    private ?string $recommendationStrength = null;

    public function setRecommendationStrength(?string $recommendationStrength): void
    {
        $this->recommendationStrength = $recommendationStrength;
    }

    public function getRecommendationStrength(): ?string
    {
        return $this->recommendationStrength;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A fact-checking review of claims made (or reported) in some creative work (referenced via itemReviewed).
 *
 * @see https://schema.org/ClaimReview
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ClaimReview'])]
class ClaimReview extends Review
{
    /**
     * A short summary of the specific claims reviewed in a ClaimReview.
     *
     * @see https://schema.org/claimReviewed
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/claimReviewed'])]
    private ?string $claimReviewed = null;

    public function setClaimReviewed(?string $claimReviewed): void
    {
        $this->claimReviewed = $claimReviewed;
    }

    public function getClaimReviewed(): ?string
    {
        return $this->claimReviewed;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * The average rating based on multiple ratings or reviews.
 *
 * @see https://schema.org/AggregateRating
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['aggregateRating' => AggregateRating::class, 'employerAggregateRating' => EmployerAggregateRating::class])]
class AggregateRating extends Rating
{
    /**
     * The count of total number of ratings.
     *
     * @see https://schema.org/ratingCount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/ratingCount'])]
    private ?int $ratingCount = null;

    /**
     * The count of total number of reviews.
     *
     * @see https://schema.org/reviewCount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/reviewCount'])]
    private ?int $reviewCount = null;

    /**
     * The item that is being reviewed/rated.
     *
     * @see https://schema.org/itemReviewed
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ApiProperty(types: ['https://schema.org/itemReviewed'])]
    private ?Thing $itemReviewed = null;

    public function setRatingCount(?int $ratingCount): void
    {
        $this->ratingCount = $ratingCount;
    }

    public function getRatingCount(): ?int
    {
        return $this->ratingCount;
    }

    public function setReviewCount(?int $reviewCount): void
    {
        $this->reviewCount = $reviewCount;
    }

    public function getReviewCount(): ?int
    {
        return $this->reviewCount;
    }

    public function setItemReviewed(?Thing $itemReviewed): void
    {
        $this->itemReviewed = $itemReviewed;
    }

    public function getItemReviewed(): ?Thing
    {
        return $this->itemReviewed;
    }
}

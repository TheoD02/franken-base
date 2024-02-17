<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A rating is an evaluation on a numeric scale, such as 1 to 5 stars.
 *
 * @see https://schema.org/Rating
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'rating' => Rating::class,
	'endorsementRating' => EndorsementRating::class,
	'aggregateRating' => AggregateRating::class,
	'employerAggregateRating' => EmployerAggregateRating::class,
])]
class Rating extends Intangible
{
	/**
	 * This Review or Rating is relevant to this part or facet of the itemReviewed.
	 *
	 * @see https://schema.org/reviewAspect
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/reviewAspect'])]
	private ?string $reviewAspect = null;

	/**
	 * The rating for the content.\\n\\nUsage guidelines:\\n\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.
	 *
	 * @see https://schema.org/ratingValue
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/ratingValue'])]
	private ?string $ratingValue = null;

	/**
	 * A short explanation (e.g. one to two sentences) providing background context and other information that led to the conclusion expressed in the rating. This is particularly applicable to ratings associated with "fact check" markup using \[\[ClaimReview\]\].
	 *
	 * @see https://schema.org/ratingExplanation
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/ratingExplanation'])]
	private ?string $ratingExplanation = null;

	/**
	 * The lowest value allowed in this rating system. If worstRating is omitted, 1 is assumed.
	 *
	 * @see https://schema.org/worstRating
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/worstRating'])]
	private ?string $worstRating = null;

	/**
	 * The author of this content or rating. Please note that author is special in that HTML 5 provides a special mechanism for indicating authorship via the rel tag. That is equivalent to this and may be used interchangeably.
	 *
	 * @see https://schema.org/author
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ApiProperty(types: ['https://schema.org/author'])]
	private ?Person $author = null;

	/**
	 * The highest value allowed in this rating system. If bestRating is omitted, 5 is assumed.
	 *
	 * @see https://schema.org/bestRating
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/bestRating'])]
	private ?string $bestRating = null;

	public function setReviewAspect(?string $reviewAspect): void
	{
		$this->reviewAspect = $reviewAspect;
	}

	public function getReviewAspect(): ?string
	{
		return $this->reviewAspect;
	}

	public function setRatingValue(?string $ratingValue): void
	{
		$this->ratingValue = $ratingValue;
	}

	public function getRatingValue(): ?string
	{
		return $this->ratingValue;
	}

	public function setRatingExplanation(?string $ratingExplanation): void
	{
		$this->ratingExplanation = $ratingExplanation;
	}

	public function getRatingExplanation(): ?string
	{
		return $this->ratingExplanation;
	}

	public function setWorstRating(?string $worstRating): void
	{
		$this->worstRating = $worstRating;
	}

	public function getWorstRating(): ?string
	{
		return $this->worstRating;
	}

	public function setAuthor(?Person $author): void
	{
		$this->author = $author;
	}

	public function getAuthor(): ?Person
	{
		return $this->author;
	}

	public function setBestRating(?string $bestRating): void
	{
		$this->bestRating = $bestRating;
	}

	public function getBestRating(): ?string
	{
		return $this->bestRating;
	}
}

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
 * A review of an item - for example, of a restaurant, movie, or store.
 *
 * @see https://schema.org/Review
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'review' => Review::class,
	'userReview' => UserReview::class,
	'employerReview' => EmployerReview::class,
	'claimReview' => ClaimReview::class,
	'criticReview' => CriticReview::class,
	'mediaReview' => MediaReview::class,
	'recommendation' => Recommendation::class,
])]
class Review extends CreativeWork
{
	/**
	 * An associated \[\[MediaReview\]\], related by specific common content, topic or claim. The expectation is that this property would be most typically used in cases where a single activity is conducting both claim reviews and media reviews, in which case \[\[relatedMediaReview\]\] would commonly be used on a \[\[ClaimReview\]\], while \[\[relatedClaimReview\]\] would be used on \[\[MediaReview\]\].
	 *
	 * @see https://schema.org/associatedMediaReview
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Review')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/associatedMediaReview'])]
	#[Assert\NotNull]
	private Review $associatedMediaReview;

	/**
	 * An associated \[\[Review\]\].
	 *
	 * @see https://schema.org/associatedReview
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Review')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/associatedReview'])]
	#[Assert\NotNull]
	private Review $associatedReview;

	/**
	 * Provides negative considerations regarding something, most typically in pro/con lists for reviews (alongside \[\[positiveNotes\]\]). For symmetry In the case of a \[\[Review\]\], the property describes the \[\[itemReviewed\]\] from the perspective of the review; in the case of a \[\[Product\]\], the product itself is being described. Since product descriptions tend to emphasise positive claims, it may be relatively unusual to find \[\[negativeNotes\]\] used in this way. Nevertheless for the sake of symmetry, \[\[negativeNotes\]\] can be used on \[\[Product\]\]. The property values can be expressed either as unstructured text (repeated as necessary), or if ordered, as a list (in which case the most negative is at the beginning of the list).
	 *
	 * @see https://schema.org/negativeNotes
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ItemList')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/negativeNotes'])]
	#[Assert\NotNull]
	private ItemList $negativeNotes;

	/**
	 * This Review or Rating is relevant to this part or facet of the itemReviewed.
	 *
	 * @see https://schema.org/reviewAspect
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/reviewAspect'])]
	private ?string $reviewAspect = null;

	/**
	 * Provides positive considerations regarding something, for example product highlights or (alongside \[\[negativeNotes\]\]) pro/con lists for reviews. In the case of a \[\[Review\]\], the property describes the \[\[itemReviewed\]\] from the perspective of the review; in the case of a \[\[Product\]\], the product itself is being described. The property values can be expressed either as unstructured text (repeated as necessary), or if ordered, as a list (in which case the most positive is at the beginning of the list).
	 *
	 * @see https://schema.org/positiveNotes
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ItemList')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/positiveNotes'])]
	#[Assert\NotNull]
	private ItemList $positiveNotes;

	/**
	 * An associated \[\[ClaimReview\]\], related by specific common content, topic or claim. The expectation is that this property would be most typically used in cases where a single activity is conducting both claim reviews and media reviews, in which case \[\[relatedMediaReview\]\] would commonly be used on a \[\[ClaimReview\]\], while \[\[relatedClaimReview\]\] would be used on \[\[MediaReview\]\].
	 *
	 * @see https://schema.org/associatedClaimReview
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Review')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/associatedClaimReview'])]
	#[Assert\NotNull]
	private Review $associatedClaimReview;

	/**
	 * The item that is being reviewed/rated.
	 *
	 * @see https://schema.org/itemReviewed
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ApiProperty(types: ['https://schema.org/itemReviewed'])]
	private ?Thing $itemReviewed = null;

	/**
	 * The actual body of the review.
	 *
	 * @see https://schema.org/reviewBody
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/reviewBody'])]
	private ?string $reviewBody = null;

	/**
	 * The rating given in this review. Note that reviews can themselves be rated. The ```reviewRating``` applies to rating given by the review. The \[\[aggregateRating\]\] property applies to the review itself, as a creative work.
	 *
	 * @see https://schema.org/reviewRating
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Rating')]
	#[ApiProperty(types: ['https://schema.org/reviewRating'])]
	private ?Rating $reviewRating = null;

	public function setAssociatedMediaReview(Review $associatedMediaReview): void
	{
		$this->associatedMediaReview = $associatedMediaReview;
	}

	public function getAssociatedMediaReview(): Review
	{
		return $this->associatedMediaReview;
	}

	public function setAssociatedReview(Review $associatedReview): void
	{
		$this->associatedReview = $associatedReview;
	}

	public function getAssociatedReview(): Review
	{
		return $this->associatedReview;
	}

	public function setNegativeNotes(ItemList $negativeNotes): void
	{
		$this->negativeNotes = $negativeNotes;
	}

	public function getNegativeNotes(): ItemList
	{
		return $this->negativeNotes;
	}

	public function setReviewAspect(?string $reviewAspect): void
	{
		$this->reviewAspect = $reviewAspect;
	}

	public function getReviewAspect(): ?string
	{
		return $this->reviewAspect;
	}

	public function setPositiveNotes(ItemList $positiveNotes): void
	{
		$this->positiveNotes = $positiveNotes;
	}

	public function getPositiveNotes(): ItemList
	{
		return $this->positiveNotes;
	}

	public function setAssociatedClaimReview(Review $associatedClaimReview): void
	{
		$this->associatedClaimReview = $associatedClaimReview;
	}

	public function getAssociatedClaimReview(): Review
	{
		return $this->associatedClaimReview;
	}

	public function setItemReviewed(?Thing $itemReviewed): void
	{
		$this->itemReviewed = $itemReviewed;
	}

	public function getItemReviewed(): ?Thing
	{
		return $this->itemReviewed;
	}

	public function setReviewBody(?string $reviewBody): void
	{
		$this->reviewBody = $reviewBody;
	}

	public function getReviewBody(): ?string
	{
		return $this->reviewBody;
	}

	public function setReviewRating(?Rating $reviewRating): void
	{
		$this->reviewRating = $reviewRating;
	}

	public function getReviewRating(): ?Rating
	{
		return $this->reviewRating;
	}
}

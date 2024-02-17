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
 * A brand is a name used by an organization or business person for labeling a product, product group, or similar.
 *
 * @see https://schema.org/Brand
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Brand'])]
class Brand extends Intangible
{
	/**
	 * An associated logo.
	 *
	 * @see https://schema.org/logo
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/logo'])]
	#[Assert\Url]
	private ?string $logo = null;

	/**
	 * The overall rating, based on a collection of reviews or ratings, of the item.
	 *
	 * @see https://schema.org/aggregateRating
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AggregateRating')]
	#[ApiProperty(types: ['https://schema.org/aggregateRating'])]
	private ?AggregateRating $aggregateRating = null;

	/**
	 * A slogan or motto associated with the item.
	 *
	 * @see https://schema.org/slogan
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/slogan'])]
	private ?string $slogan = null;

	/**
	 * A review of the item.
	 *
	 * @see https://schema.org/review
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Review')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/review'])]
	#[Assert\NotNull]
	private Review $review;

	public function setLogo(?string $logo): void
	{
		$this->logo = $logo;
	}

	public function getLogo(): ?string
	{
		return $this->logo;
	}

	public function setAggregateRating(?AggregateRating $aggregateRating): void
	{
		$this->aggregateRating = $aggregateRating;
	}

	public function getAggregateRating(): ?AggregateRating
	{
		return $this->aggregateRating;
	}

	public function setSlogan(?string $slogan): void
	{
		$this->slogan = $slogan;
	}

	public function getSlogan(): ?string
	{
		return $this->slogan;
	}

	public function setReview(Review $review): void
	{
		$this->review = $review;
	}

	public function getReview(): Review
	{
		return $this->review;
	}
}

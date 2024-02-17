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
 * \[\[Guide\]\] is a page or article that recommends specific products or services, or aspects of a thing for a user to consider. A \[\[Guide\]\] may represent a Buying Guide and detail aspects of products or services for a user to consider. A \[\[Guide\]\] may represent a Product Guide and recommend specific products or services. A \[\[Guide\]\] may represent a Ranked List and recommend specific products or services with ranking.
 *
 * @see https://schema.org/Guide
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Guide'])]
class Guide extends CreativeWork
{
	/**
	 * This Review or Rating is relevant to this part or facet of the itemReviewed.
	 *
	 * @see https://schema.org/reviewAspect
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/reviewAspect'])]
	private ?string $reviewAspect = null;

	public function setReviewAspect(?string $reviewAspect): void
	{
		$this->reviewAspect = $reviewAspect;
	}

	public function getReviewAspect(): ?string
	{
		return $this->reviewAspect;
	}
}

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
 * The act of producing a balanced opinion about the object for an audience. An agent reviews an object with participants resulting in a review.
 *
 * @see https://schema.org/ReviewAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ReviewAction'])]
class ReviewAction extends AssessAction
{
	/**
	 * A sub property of result. The review that resulted in the performing of the action.
	 *
	 * @see https://schema.org/resultReview
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Review')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/resultReview'])]
	#[Assert\NotNull]
	private Review $resultReview;

	public function setResultReview(Review $resultReview): void
	{
		$this->resultReview = $resultReview;
	}

	public function getResultReview(): Review
	{
		return $this->resultReview;
	}
}

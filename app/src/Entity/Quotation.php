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
 * A quotation. Often but not necessarily from some written work, attributable to a real world author and - if associated with a fictional character - to any fictional Person. Use \[\[isBasedOn\]\] to link to source/origin. The \[\[recordedIn\]\] property can be used to reference a Quotation from an \[\[Event\]\].
 *
 * @see https://schema.org/Quotation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Quotation'])]
class Quotation extends CreativeWork
{
	/**
	 * The (e.g. fictional) character, Person or Organization to whom the quotation is attributed within the containing CreativeWork.
	 *
	 * @see https://schema.org/spokenByCharacter
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/spokenByCharacter'])]
	private ?Organization $spokenByCharacter = null;

	public function setSpokenByCharacter(?Organization $spokenByCharacter): void
	{
		$this->spokenByCharacter = $spokenByCharacter;
	}

	public function getSpokenByCharacter(): ?Organization
	{
		return $this->spokenByCharacter;
	}
}

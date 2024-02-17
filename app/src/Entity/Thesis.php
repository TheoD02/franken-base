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
 * A thesis or dissertation document submitted in support of candidature for an academic degree or professional qualification.
 *
 * @see https://schema.org/Thesis
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Thesis'])]
class Thesis extends CreativeWork
{
	/**
	 * Qualification, candidature, degree, application that Thesis supports.
	 *
	 * @see https://schema.org/inSupportOf
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/inSupportOf'])]
	private ?string $inSupportOf = null;

	public function setInSupportOf(?string $inSupportOf): void
	{
		$this->inSupportOf = $inSupportOf;
	}

	public function getInSupportOf(): ?string
	{
		return $this->inSupportOf;
	}
}

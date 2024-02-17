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
 * A scholarly article in the medical domain.
 *
 * @see https://schema.org/MedicalScholarlyArticle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalScholarlyArticle'])]
class MedicalScholarlyArticle extends ScholarlyArticle
{
	/**
	 * The type of the medical article, taken from the US NLM MeSH publication type catalog. See also \[MeSH documentation\](http://www.nlm.nih.gov/mesh/pubtypes.html).
	 *
	 * @see https://schema.org/publicationType
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/publicationType'])]
	private ?string $publicationType = null;

	public function setPublicationType(?string $publicationType): void
	{
		$this->publicationType = $publicationType;
	}

	public function getPublicationType(): ?string
	{
		return $this->publicationType;
	}
}

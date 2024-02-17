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
 * A WebSite is a set of related web pages and other items typically served from a single web domain and accessible via URLs.
 *
 * @see https://schema.org/WebSite
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WebSite'])]
class WebSite extends CreativeWork
{
	/**
	 * The International Standard Serial Number (ISSN) that identifies this serial publication. You can repeat this property to identify different formats of, or the linking ISSN (ISSN-L) for, this serial publication.
	 *
	 * @see https://schema.org/issn
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/issn'])]
	private ?string $issn = null;

	public function setIssn(?string $issn): void
	{
		$this->issn = $issn;
	}

	public function getIssn(): ?string
	{
		return $this->issn;
	}
}

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
 * A part of a successively published publication such as a periodical or multi-volume work, often numbered. It may represent a time span, such as a year.\\n\\nSee also \[blog post\](http://blog.schema.org/2014/09/schemaorg-support-for-bibliographic\_2.html).
 *
 * @see https://schema.org/PublicationVolume
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PublicationVolume'])]
class PublicationVolume extends CreativeWork
{
	/**
	 * Any description of pages that is not separated into pageStart and pageEnd; for example, "1-6, 9, 55" or "10-12, 46-49".
	 *
	 * @see https://schema.org/pagination
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/pagination'])]
	private ?string $pagination = null;

	/**
	 * The page on which the work ends; for example "138" or "xvi".
	 *
	 * @see https://schema.org/pageEnd
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/pageEnd'])]
	private ?int $pageEnd = null;

	/**
	 * The page on which the work starts; for example "135" or "xiii".
	 *
	 * @see https://schema.org/pageStart
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/pageStart'])]
	private ?int $pageStart = null;

	/**
	 * Identifies the volume of publication or multi-part work; for example, "iii" or "2".
	 *
	 * @see https://schema.org/volumeNumber
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/volumeNumber'])]
	private ?string $volumeNumber = null;

	public function setPagination(?string $pagination): void
	{
		$this->pagination = $pagination;
	}

	public function getPagination(): ?string
	{
		return $this->pagination;
	}

	public function setPageEnd(?int $pageEnd): void
	{
		$this->pageEnd = $pageEnd;
	}

	public function getPageEnd(): ?int
	{
		return $this->pageEnd;
	}

	public function setPageStart(?int $pageStart): void
	{
		$this->pageStart = $pageStart;
	}

	public function getPageStart(): ?int
	{
		return $this->pageStart;
	}

	public function setVolumeNumber(?string $volumeNumber): void
	{
		$this->volumeNumber = $volumeNumber;
	}

	public function getVolumeNumber(): ?string
	{
		return $this->volumeNumber;
	}
}

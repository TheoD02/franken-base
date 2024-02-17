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
 * A Category Code.
 *
 * @see https://schema.org/CategoryCode
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CategoryCode'])]
class CategoryCode extends DefinedTerm
{
	/**
	 * A \[\[CategoryCodeSet\]\] that contains this category code.
	 *
	 * @see https://schema.org/inCodeSet
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CategoryCodeSet')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/inCodeSet'])]
	#[Assert\NotNull]
	private CategoryCodeSet $inCodeSet;

	/**
	 * A short textual code that uniquely identifies the value.
	 *
	 * @see https://schema.org/codeValue
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/codeValue'])]
	private ?string $codeValue = null;

	public function setInCodeSet(CategoryCodeSet $inCodeSet): void
	{
		$this->inCodeSet = $inCodeSet;
	}

	public function getInCodeSet(): CategoryCodeSet
	{
		return $this->inCodeSet;
	}

	public function setCodeValue(?string $codeValue): void
	{
		$this->codeValue = $codeValue;
	}

	public function getCodeValue(): ?string
	{
		return $this->codeValue;
	}
}

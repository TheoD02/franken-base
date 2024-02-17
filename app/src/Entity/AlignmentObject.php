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
 * An intangible item that describes an alignment between a learning resource and a node in an educational framework. Should not be used where the nature of the alignment can be described using a simple property, for example to express that a resource \[\[teaches\]\] or \[\[assesses\]\] a competency.
 *
 * @see https://schema.org/AlignmentObject
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AlignmentObject'])]
class AlignmentObject extends Intangible
{
	/**
	 * The description of a node in an established educational framework.
	 *
	 * @see https://schema.org/targetDescription
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/targetDescription'])]
	private ?string $targetDescription = null;

	/**
	 * A category of alignment between the learning resource and the framework node. Recommended values include: 'requires', 'textComplexity', 'readingLevel', and 'educationalSubject'.
	 *
	 * @see https://schema.org/alignmentType
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/alignmentType'])]
	private ?string $alignmentType = null;

	/**
	 * The URL of a node in an established educational framework.
	 *
	 * @see https://schema.org/targetUrl
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/targetUrl'])]
	#[Assert\Url]
	private ?string $targetUrl = null;

	/**
	 * The name of a node in an established educational framework.
	 *
	 * @see https://schema.org/targetName
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/targetName'])]
	private ?string $targetName = null;

	/**
	 * The framework to which the resource being described is aligned.
	 *
	 * @see https://schema.org/educationalFramework
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/educationalFramework'])]
	private ?string $educationalFramework = null;

	public function setTargetDescription(?string $targetDescription): void
	{
		$this->targetDescription = $targetDescription;
	}

	public function getTargetDescription(): ?string
	{
		return $this->targetDescription;
	}

	public function setAlignmentType(?string $alignmentType): void
	{
		$this->alignmentType = $alignmentType;
	}

	public function getAlignmentType(): ?string
	{
		return $this->alignmentType;
	}

	public function setTargetUrl(?string $targetUrl): void
	{
		$this->targetUrl = $targetUrl;
	}

	public function getTargetUrl(): ?string
	{
		return $this->targetUrl;
	}

	public function setTargetName(?string $targetName): void
	{
		$this->targetName = $targetName;
	}

	public function getTargetName(): ?string
	{
		return $this->targetName;
	}

	public function setEducationalFramework(?string $educationalFramework): void
	{
		$this->educationalFramework = $educationalFramework;
	}

	public function getEducationalFramework(): ?string
	{
		return $this->educationalFramework;
	}
}

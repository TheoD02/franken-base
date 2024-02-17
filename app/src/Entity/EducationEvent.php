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
 * Event type: Education event.
 *
 * @see https://schema.org/EducationEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EducationEvent'])]
class EducationEvent extends Event
{
	/**
	 * The item being described is intended to help a person learn the competency or learning outcome defined by the referenced term.
	 *
	 * @see https://schema.org/teaches
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/teaches'])]
	private ?string $teaches = null;

	/**
	 * The item being described is intended to assess the competency or learning outcome defined by the referenced term.
	 *
	 * @see https://schema.org/assesses
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/assesses'])]
	private ?string $assesses = null;

	/**
	 * The level in terms of progression through an educational or training context. Examples of educational levels include 'beginner', 'intermediate' or 'advanced', and formal sets of level indicators.
	 *
	 * @see https://schema.org/educationalLevel
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/educationalLevel'])]
	private ?string $educationalLevel = null;

	public function setTeaches(?string $teaches): void
	{
		$this->teaches = $teaches;
	}

	public function getTeaches(): ?string
	{
		return $this->teaches;
	}

	public function setAssesses(?string $assesses): void
	{
		$this->assesses = $assesses;
	}

	public function getAssesses(): ?string
	{
		return $this->assesses;
	}

	public function setEducationalLevel(?string $educationalLevel): void
	{
		$this->educationalLevel = $educationalLevel;
	}

	public function getEducationalLevel(): ?string
	{
		return $this->educationalLevel;
	}
}

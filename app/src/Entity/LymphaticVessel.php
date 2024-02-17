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
 * A type of blood vessel that specifically carries lymph fluid unidirectionally toward the heart.
 *
 * @see https://schema.org/LymphaticVessel
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LymphaticVessel'])]
class LymphaticVessel extends Vessel
{
	/**
	 * The anatomical or organ system drained by this vessel; generally refers to a specific part of an organ.
	 *
	 * @see https://schema.org/regionDrained
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalSystem')]
	#[ApiProperty(types: ['https://schema.org/regionDrained'])]
	private ?AnatomicalSystem $regionDrained = null;

	/**
	 * The vasculature the lymphatic structure originates, or afferents, from.
	 *
	 * @see https://schema.org/originatesFrom
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Vessel')]
	#[ApiProperty(types: ['https://schema.org/originatesFrom'])]
	private ?Vessel $originatesFrom = null;

	/**
	 * The vasculature the lymphatic structure runs, or efferents, to.
	 *
	 * @see https://schema.org/runsTo
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Vessel')]
	#[ApiProperty(types: ['https://schema.org/runsTo'])]
	private ?Vessel $runsTo = null;

	public function setRegionDrained(?AnatomicalSystem $regionDrained): void
	{
		$this->regionDrained = $regionDrained;
	}

	public function getRegionDrained(): ?AnatomicalSystem
	{
		return $this->regionDrained;
	}

	public function setOriginatesFrom(?Vessel $originatesFrom): void
	{
		$this->originatesFrom = $originatesFrom;
	}

	public function getOriginatesFrom(): ?Vessel
	{
		return $this->originatesFrom;
	}

	public function setRunsTo(?Vessel $runsTo): void
	{
		$this->runsTo = $runsTo;
	}

	public function getRunsTo(): ?Vessel
	{
		return $this->runsTo;
	}
}

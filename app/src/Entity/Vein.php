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
 * A type of blood vessel that specifically carries blood to the heart.
 *
 * @see https://schema.org/Vein
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Vein'])]
class Vein extends Vessel
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
	 * The vasculature that the vein drains into.
	 *
	 * @see https://schema.org/drainsTo
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Vessel')]
	#[ApiProperty(types: ['https://schema.org/drainsTo'])]
	private ?Vessel $drainsTo = null;

	/**
	 * The anatomical or organ system that the vein flows into; a larger structure that the vein connects to.
	 *
	 * @see https://schema.org/tributary
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalStructure')]
	#[ApiProperty(types: ['https://schema.org/tributary'])]
	private ?AnatomicalStructure $tributary = null;

	public function setRegionDrained(?AnatomicalSystem $regionDrained): void
	{
		$this->regionDrained = $regionDrained;
	}

	public function getRegionDrained(): ?AnatomicalSystem
	{
		return $this->regionDrained;
	}

	public function setDrainsTo(?Vessel $drainsTo): void
	{
		$this->drainsTo = $drainsTo;
	}

	public function getDrainsTo(): ?Vessel
	{
		return $this->drainsTo;
	}

	public function setTributary(?AnatomicalStructure $tributary): void
	{
		$this->tributary = $tributary;
	}

	public function getTributary(): ?AnatomicalStructure
	{
		return $this->tributary;
	}
}

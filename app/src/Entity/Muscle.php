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
 * A muscle is an anatomical structure consisting of a contractile form of tissue that animals use to effect movement.
 *
 * @see https://schema.org/Muscle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Muscle'])]
class Muscle extends AnatomicalStructure
{
	/**
	 * The blood vessel that carries blood from the heart to the muscle.
	 *
	 * @see https://schema.org/bloodSupply
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Vessel')]
	#[ApiProperty(types: ['https://schema.org/bloodSupply'])]
	private ?Vessel $bloodSupply = null;

	/**
	 * The underlying innervation associated with the muscle.
	 *
	 * @see https://schema.org/nerve
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Nerve')]
	#[ApiProperty(types: ['https://schema.org/nerve'])]
	private ?Nerve $nerve = null;

	/**
	 * The muscle whose action counteracts the specified muscle.
	 *
	 * @see https://schema.org/antagonist
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Muscle')]
	#[ApiProperty(types: ['https://schema.org/antagonist'])]
	private ?Muscle $antagonist = null;

	/**
	 * The place of attachment of a muscle, or what the muscle moves.
	 *
	 * @see https://schema.org/insertion
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalStructure')]
	#[ApiProperty(types: ['https://schema.org/insertion'])]
	private ?AnatomicalStructure $insertion = null;

	/**
	 * The movement the muscle generates.
	 *
	 * @see https://schema.org/muscleAction
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/muscleAction'])]
	private ?string $muscleAction = null;

	public function setBloodSupply(?Vessel $bloodSupply): void
	{
		$this->bloodSupply = $bloodSupply;
	}

	public function getBloodSupply(): ?Vessel
	{
		return $this->bloodSupply;
	}

	public function setNerve(?Nerve $nerve): void
	{
		$this->nerve = $nerve;
	}

	public function getNerve(): ?Nerve
	{
		return $this->nerve;
	}

	public function setAntagonist(?Muscle $antagonist): void
	{
		$this->antagonist = $antagonist;
	}

	public function getAntagonist(): ?Muscle
	{
		return $this->antagonist;
	}

	public function setInsertion(?AnatomicalStructure $insertion): void
	{
		$this->insertion = $insertion;
	}

	public function getInsertion(): ?AnatomicalStructure
	{
		return $this->insertion;
	}

	public function setMuscleAction(?string $muscleAction): void
	{
		$this->muscleAction = $muscleAction;
	}

	public function getMuscleAction(): ?string
	{
		return $this->muscleAction;
	}
}

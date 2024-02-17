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
 * A common pathway for the electrochemical nerve impulses that are transmitted along each of the axons.
 *
 * @see https://schema.org/Nerve
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Nerve'])]
class Nerve extends AnatomicalStructure
{
	/**
	 * The neurological pathway extension that inputs and sends information to the brain or spinal cord.
	 *
	 * @see https://schema.org/sensoryUnit
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AnatomicalStructure')]
	#[ApiProperty(types: ['https://schema.org/sensoryUnit'])]
	private ?AnatomicalStructure $sensoryUnit = null;

	/**
	 * The neurological pathway that originates the neurons.
	 *
	 * @see https://schema.org/sourcedFrom
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BrainStructure')]
	#[ApiProperty(types: ['https://schema.org/sourcedFrom'])]
	private ?BrainStructure $sourcedFrom = null;

	/**
	 * The neurological pathway extension that involves muscle control.
	 *
	 * @see https://schema.org/nerveMotor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Muscle')]
	#[ApiProperty(types: ['https://schema.org/nerveMotor'])]
	private ?Muscle $nerveMotor = null;

	public function setSensoryUnit(?AnatomicalStructure $sensoryUnit): void
	{
		$this->sensoryUnit = $sensoryUnit;
	}

	public function getSensoryUnit(): ?AnatomicalStructure
	{
		return $this->sensoryUnit;
	}

	public function setSourcedFrom(?BrainStructure $sourcedFrom): void
	{
		$this->sourcedFrom = $sourcedFrom;
	}

	public function getSourcedFrom(): ?BrainStructure
	{
		return $this->sourcedFrom;
	}

	public function setNerveMotor(?Muscle $nerveMotor): void
	{
		$this->nerveMotor = $nerveMotor;
	}

	public function getNerveMotor(): ?Muscle
	{
		return $this->nerveMotor;
	}
}

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
 * A specific strength in which a medical drug is available in a specific country.
 *
 * @see https://schema.org/DrugStrength
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DrugStrength'])]
class DrugStrength extends MedicalIntangible
{
	/**
	 * An active ingredient, typically chemical compounds and/or biologic substances.
	 *
	 * @see https://schema.org/activeIngredient
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/activeIngredient'])]
	private ?string $activeIngredient = null;

	/**
	 * The units of an active ingredient's strength, e.g. mg.
	 *
	 * @see https://schema.org/strengthUnit
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/strengthUnit'])]
	private ?string $strengthUnit = null;

	/**
	 * The value of an active ingredient's strength, e.g. 325.
	 *
	 * @see https://schema.org/strengthValue
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/strengthValue'])]
	private ?string $strengthValue = null;

	/**
	 * Recommended intake of this supplement for a given population as defined by a specific recommending authority.
	 *
	 * @see https://schema.org/maximumIntake
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MaximumDoseSchedule')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/maximumIntake'])]
	#[Assert\NotNull]
	private MaximumDoseSchedule $maximumIntake;

	/**
	 * The location in which the strength is available.
	 *
	 * @see https://schema.org/availableIn
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
	#[ApiProperty(types: ['https://schema.org/availableIn'])]
	private ?AdministrativeArea $availableIn = null;

	public function setActiveIngredient(?string $activeIngredient): void
	{
		$this->activeIngredient = $activeIngredient;
	}

	public function getActiveIngredient(): ?string
	{
		return $this->activeIngredient;
	}

	public function setStrengthUnit(?string $strengthUnit): void
	{
		$this->strengthUnit = $strengthUnit;
	}

	public function getStrengthUnit(): ?string
	{
		return $this->strengthUnit;
	}

	public function setStrengthValue(?string $strengthValue): void
	{
		$this->strengthValue = $strengthValue;
	}

	public function getStrengthValue(): ?string
	{
		return $this->strengthValue;
	}

	public function setMaximumIntake(MaximumDoseSchedule $maximumIntake): void
	{
		$this->maximumIntake = $maximumIntake;
	}

	public function getMaximumIntake(): MaximumDoseSchedule
	{
		return $this->maximumIntake;
	}

	public function setAvailableIn(?AdministrativeArea $availableIn): void
	{
		$this->availableIn = $availableIn;
	}

	public function getAvailableIn(): ?AdministrativeArea
	{
		return $this->availableIn;
	}
}

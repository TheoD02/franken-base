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
 * Residence type: Apartment complex.
 *
 * @see https://schema.org/ApartmentComplex
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ApartmentComplex'])]
class ApartmentComplex extends Residence
{
	/**
	 * The total integer number of bedrooms in a some \[\[Accommodation\]\], \[\[ApartmentComplex\]\] or \[\[FloorPlan\]\].
	 *
	 * @see https://schema.org/numberOfBedrooms
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/numberOfBedrooms'])]
	private ?string $numberOfBedrooms = null;

	/**
	 * Indicates the number of available accommodation units in an \[\[ApartmentComplex\]\], or the number of accommodation units for a specific \[\[FloorPlan\]\] (within its specific \[\[ApartmentComplex\]\]). See also \[\[numberOfAccommodationUnits\]\].
	 *
	 * @see https://schema.org/numberOfAvailableAccommodationUnits
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/numberOfAvailableAccommodationUnits'])]
	#[Assert\NotNull]
	private QuantitativeValue $numberOfAvailableAccommodationUnits;

	/**
	 * Indicates the total (available plus unavailable) number of accommodation units in an \[\[ApartmentComplex\]\], or the number of accommodation units for a specific \[\[FloorPlan\]\] (within its specific \[\[ApartmentComplex\]\]). See also \[\[numberOfAvailableAccommodationUnits\]\].
	 *
	 * @see https://schema.org/numberOfAccommodationUnits
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/numberOfAccommodationUnits'])]
	#[Assert\NotNull]
	private QuantitativeValue $numberOfAccommodationUnits;

	/**
	 * Indicates whether pets are allowed to enter the accommodation or lodging business. More detailed information can be put in a text value.
	 *
	 * @see https://schema.org/petsAllowed
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/petsAllowed'])]
	private ?bool $petsAllowed = null;

	public function setNumberOfBedrooms(?string $numberOfBedrooms): void
	{
		$this->numberOfBedrooms = $numberOfBedrooms;
	}

	public function getNumberOfBedrooms(): ?string
	{
		return $this->numberOfBedrooms;
	}

	public function setNumberOfAvailableAccommodationUnits(QuantitativeValue $numberOfAvailableAccommodationUnits): void
	{
		$this->numberOfAvailableAccommodationUnits = $numberOfAvailableAccommodationUnits;
	}

	public function getNumberOfAvailableAccommodationUnits(): QuantitativeValue
	{
		return $this->numberOfAvailableAccommodationUnits;
	}

	public function setNumberOfAccommodationUnits(QuantitativeValue $numberOfAccommodationUnits): void
	{
		$this->numberOfAccommodationUnits = $numberOfAccommodationUnits;
	}

	public function getNumberOfAccommodationUnits(): QuantitativeValue
	{
		return $this->numberOfAccommodationUnits;
	}

	public function setPetsAllowed(?bool $petsAllowed): void
	{
		$this->petsAllowed = $petsAllowed;
	}

	public function getPetsAllowed(): ?bool
	{
		return $this->petsAllowed;
	}
}

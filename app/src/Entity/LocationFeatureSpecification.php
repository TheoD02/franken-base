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
 * Specifies a location feature by providing a structured value representing a feature of an accommodation as a property-value pair of varying degrees of formality.
 *
 * @see https://schema.org/LocationFeatureSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LocationFeatureSpecification'])]
class LocationFeatureSpecification extends PropertyValue
{
	/**
	 * The date when the item becomes valid.
	 *
	 * @see https://schema.org/validFrom
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/validFrom'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $validFrom = null;

	/**
	 * The hours during which this service or contact is available.
	 *
	 * @see https://schema.org/hoursAvailable
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\OpeningHoursSpecification')]
	#[ApiProperty(types: ['https://schema.org/hoursAvailable'])]
	private ?OpeningHoursSpecification $hoursAvailable = null;

	/**
	 * The date after when the item is not valid. For example the end of an offer, salary period, or a period of opening hours.
	 *
	 * @see https://schema.org/validThrough
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/validThrough'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $validThrough = null;

	public function setValidFrom(?\DateTimeInterface $validFrom): void
	{
		$this->validFrom = $validFrom;
	}

	public function getValidFrom(): ?\DateTimeInterface
	{
		return $this->validFrom;
	}

	public function setHoursAvailable(?OpeningHoursSpecification $hoursAvailable): void
	{
		$this->hoursAvailable = $hoursAvailable;
	}

	public function getHoursAvailable(): ?OpeningHoursSpecification
	{
		return $this->hoursAvailable;
	}

	public function setValidThrough(?\DateTimeInterface $validThrough): void
	{
		$this->validThrough = $validThrough;
	}

	public function getValidThrough(): ?\DateTimeInterface
	{
		return $this->validThrough;
	}
}

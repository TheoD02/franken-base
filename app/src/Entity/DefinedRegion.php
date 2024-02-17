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
 * A DefinedRegion is a geographic area defined by potentially arbitrary (rather than political, administrative or natural geographical) criteria. Properties are provided for defining a region by reference to sets of postal codes. Examples: a delivery destination when shopping. Region where regional pricing is configured. Requirement 1: Country: US States: "NY", "CA" Requirement 2: Country: US PostalCode Set: { \[94000-94585\], \[97000, 97999\], \[13000, 13599\]} { \[12345, 12345\], \[78945, 78945\], } Region = state, canton, prefecture, autonomous community...
 *
 * @see https://schema.org/DefinedRegion
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DefinedRegion'])]
class DefinedRegion extends StructuredValue
{
	/**
	 * The country. For example, USA. You can also provide the two-letter \[ISO 3166-1 alpha-2 country code\](http://en.wikipedia.org/wiki/ISO\_3166-1).
	 *
	 * @see https://schema.org/addressCountry
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Country')]
	#[ApiProperty(types: ['https://schema.org/addressCountry'])]
	private ?Country $addressCountry = null;

	/**
	 * The region in which the locality is, and which is in the country. For example, California or another appropriate first-level \[Administrative division\](https://en.wikipedia.org/wiki/List\_of\_administrative\_divisions\_by\_country).
	 *
	 * @see https://schema.org/addressRegion
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/addressRegion'])]
	private ?string $addressRegion = null;

	/**
	 * A defined range of postal codes.
	 *
	 * @see https://schema.org/postalCodeRange
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PostalCodeRangeSpecification')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/postalCodeRange'])]
	#[Assert\NotNull]
	private PostalCodeRangeSpecification $postalCodeRange;

	/**
	 * The postal code. For example, 94043.
	 *
	 * @see https://schema.org/postalCode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/postalCode'])]
	private ?string $postalCode = null;

	/**
	 * A defined range of postal codes indicated by a common textual prefix. Used for non-numeric systems such as UK.
	 *
	 * @see https://schema.org/postalCodePrefix
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/postalCodePrefix'])]
	private ?string $postalCodePrefix = null;

	public function setAddressCountry(?Country $addressCountry): void
	{
		$this->addressCountry = $addressCountry;
	}

	public function getAddressCountry(): ?Country
	{
		return $this->addressCountry;
	}

	public function setAddressRegion(?string $addressRegion): void
	{
		$this->addressRegion = $addressRegion;
	}

	public function getAddressRegion(): ?string
	{
		return $this->addressRegion;
	}

	public function setPostalCodeRange(PostalCodeRangeSpecification $postalCodeRange): void
	{
		$this->postalCodeRange = $postalCodeRange;
	}

	public function getPostalCodeRange(): PostalCodeRangeSpecification
	{
		return $this->postalCodeRange;
	}

	public function setPostalCode(?string $postalCode): void
	{
		$this->postalCode = $postalCode;
	}

	public function getPostalCode(): ?string
	{
		return $this->postalCode;
	}

	public function setPostalCodePrefix(?string $postalCodePrefix): void
	{
		$this->postalCodePrefix = $postalCodePrefix;
	}

	public function getPostalCodePrefix(): ?string
	{
		return $this->postalCodePrefix;
	}
}

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
 * The geographic coordinates of a place or event.
 *
 * @see https://schema.org/GeoCoordinates
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GeoCoordinates'])]
class GeoCoordinates extends StructuredValue
{
	/**
	 * Physical address of the item.
	 *
	 * @see https://schema.org/address
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/address'])]
	private ?string $address = null;

	/**
	 * The country. For example, USA. You can also provide the two-letter \[ISO 3166-1 alpha-2 country code\](http://en.wikipedia.org/wiki/ISO\_3166-1).
	 *
	 * @see https://schema.org/addressCountry
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Country')]
	#[ApiProperty(types: ['https://schema.org/addressCountry'])]
	private ?Country $addressCountry = null;

	/**
	 * The latitude of a location. For example ```37.42242``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
	 *
	 * @see https://schema.org/latitude
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/latitude'])]
	private ?string $latitude = null;

	/**
	 * The longitude of a location. For example ```-122.08585``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
	 *
	 * @see https://schema.org/longitude
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/longitude'])]
	private ?string $longitude = null;

	/**
	 * The postal code. For example, 94043.
	 *
	 * @see https://schema.org/postalCode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/postalCode'])]
	private ?string $postalCode = null;

	/**
	 * The elevation of a location (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)). Values may be of the form 'NUMBER UNIT\\\_OF\\\_MEASUREMENT' (e.g., '1,000 m', '3,200 ft') while numbers alone should be assumed to be a value in meters.
	 *
	 * @see https://schema.org/elevation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/elevation'])]
	private ?string $elevation = null;

	public function setAddress(?string $address): void
	{
		$this->address = $address;
	}

	public function getAddress(): ?string
	{
		return $this->address;
	}

	public function setAddressCountry(?Country $addressCountry): void
	{
		$this->addressCountry = $addressCountry;
	}

	public function getAddressCountry(): ?Country
	{
		return $this->addressCountry;
	}

	public function setLatitude(?string $latitude): void
	{
		$this->latitude = $latitude;
	}

	public function getLatitude(): ?string
	{
		return $this->latitude;
	}

	public function setLongitude(?string $longitude): void
	{
		$this->longitude = $longitude;
	}

	public function getLongitude(): ?string
	{
		return $this->longitude;
	}

	public function setPostalCode(?string $postalCode): void
	{
		$this->postalCode = $postalCode;
	}

	public function getPostalCode(): ?string
	{
		return $this->postalCode;
	}

	public function setElevation(?string $elevation): void
	{
		$this->elevation = $elevation;
	}

	public function getElevation(): ?string
	{
		return $this->elevation;
	}
}

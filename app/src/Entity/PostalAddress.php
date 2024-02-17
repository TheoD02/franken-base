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
 * The mailing address.
 *
 * @see https://schema.org/PostalAddress
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PostalAddress'])]
class PostalAddress extends ContactPoint
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
	 * The locality in which the street address is, and which is in the region. For example, Mountain View.
	 *
	 * @see https://schema.org/addressLocality
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/addressLocality'])]
	private ?string $addressLocality = null;

	/**
	 * The postal code. For example, 94043.
	 *
	 * @see https://schema.org/postalCode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/postalCode'])]
	private ?string $postalCode = null;

	/**
	 * The post office box number for PO box addresses.
	 *
	 * @see https://schema.org/postOfficeBoxNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/postOfficeBoxNumber'])]
	private ?string $postOfficeBoxNumber = null;

	/**
	 * The street address. For example, 1600 Amphitheatre Pkwy.
	 *
	 * @see https://schema.org/streetAddress
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/streetAddress'])]
	private ?string $streetAddress = null;

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

	public function setAddressLocality(?string $addressLocality): void
	{
		$this->addressLocality = $addressLocality;
	}

	public function getAddressLocality(): ?string
	{
		return $this->addressLocality;
	}

	public function setPostalCode(?string $postalCode): void
	{
		$this->postalCode = $postalCode;
	}

	public function getPostalCode(): ?string
	{
		return $this->postalCode;
	}

	public function setPostOfficeBoxNumber(?string $postOfficeBoxNumber): void
	{
		$this->postOfficeBoxNumber = $postOfficeBoxNumber;
	}

	public function getPostOfficeBoxNumber(): ?string
	{
		return $this->postOfficeBoxNumber;
	}

	public function setStreetAddress(?string $streetAddress): void
	{
		$this->streetAddress = $streetAddress;
	}

	public function getStreetAddress(): ?string
	{
		return $this->streetAddress;
	}
}

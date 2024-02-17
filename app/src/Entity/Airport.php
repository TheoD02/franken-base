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
 * An airport.
 *
 * @see https://schema.org/Airport
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Airport'])]
class Airport extends CivicStructure
{
	/**
	 * ICAO identifier for an airport.
	 *
	 * @see https://schema.org/icaoCode
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/icaoCode'])]
	private ?string $icaoCode = null;

	/**
	 * IATA identifier for an airline or airport.
	 *
	 * @see https://schema.org/iataCode
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/iataCode'])]
	private ?string $iataCode = null;

	public function setIcaoCode(?string $icaoCode): void
	{
		$this->icaoCode = $icaoCode;
	}

	public function getIcaoCode(): ?string
	{
		return $this->icaoCode;
	}

	public function setIataCode(?string $iataCode): void
	{
		$this->iataCode = $iataCode;
	}

	public function getIataCode(): ?string
	{
		return $this->iataCode;
	}
}

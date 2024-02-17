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
 * A reservation for air travel.\\n\\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations. For offers of tickets, use \[\[Offer\]\].
 *
 * @see https://schema.org/FlightReservation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FlightReservation'])]
class FlightReservation extends Reservation
{
	/**
	 * The type of security screening the passenger is subject to.
	 *
	 * @see https://schema.org/securityScreening
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/securityScreening'])]
	private ?string $securityScreening = null;

	/**
	 * The priority status assigned to a passenger for security or boarding (e.g. FastTrack or Priority).
	 *
	 * @see https://schema.org/passengerPriorityStatus
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/passengerPriorityStatus'])]
	private ?string $passengerPriorityStatus = null;

	/**
	 * The airline-specific indicator of boarding order / preference.
	 *
	 * @see https://schema.org/boardingGroup
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/boardingGroup'])]
	private ?string $boardingGroup = null;

	/**
	 * The passenger's sequence number as assigned by the airline.
	 *
	 * @see https://schema.org/passengerSequenceNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/passengerSequenceNumber'])]
	private ?string $passengerSequenceNumber = null;

	public function setSecurityScreening(?string $securityScreening): void
	{
		$this->securityScreening = $securityScreening;
	}

	public function getSecurityScreening(): ?string
	{
		return $this->securityScreening;
	}

	public function setPassengerPriorityStatus(?string $passengerPriorityStatus): void
	{
		$this->passengerPriorityStatus = $passengerPriorityStatus;
	}

	public function getPassengerPriorityStatus(): ?string
	{
		return $this->passengerPriorityStatus;
	}

	public function setBoardingGroup(?string $boardingGroup): void
	{
		$this->boardingGroup = $boardingGroup;
	}

	public function getBoardingGroup(): ?string
	{
		return $this->boardingGroup;
	}

	public function setPassengerSequenceNumber(?string $passengerSequenceNumber): void
	{
		$this->passengerSequenceNumber = $passengerSequenceNumber;
	}

	public function getPassengerSequenceNumber(): ?string
	{
		return $this->passengerSequenceNumber;
	}
}

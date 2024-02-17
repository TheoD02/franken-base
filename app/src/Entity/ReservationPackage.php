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
 * A group of multiple reservations with common values for all sub-reservations.
 *
 * @see https://schema.org/ReservationPackage
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ReservationPackage'])]
class ReservationPackage extends Reservation
{
	/**
	 * The individual reservations included in the package. Typically a repeated property.
	 *
	 * @see https://schema.org/subReservation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Reservation')]
	#[ApiProperty(types: ['https://schema.org/subReservation'])]
	private ?Reservation $subReservation = null;

	public function setSubReservation(?Reservation $subReservation): void
	{
		$this->subReservation = $subReservation;
	}

	public function getSubReservation(): ?Reservation
	{
		return $this->subReservation;
	}
}

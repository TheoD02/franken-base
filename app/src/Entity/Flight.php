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
use App\Enum\BoardingPolicyType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An airline flight.
 *
 * @see https://schema.org/Flight
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Flight'])]
class Flight extends Trip
{
	/**
	 * Identifier of the flight's arrival gate.
	 *
	 * @see https://schema.org/arrivalGate
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/arrivalGate'])]
	private ?string $arrivalGate = null;

	/**
	 * The type of boarding policy used by the airline (e.g. zone-based or group-based).
	 *
	 * @see https://schema.org/boardingPolicy
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/boardingPolicy'])]
	#[Assert\Choice(callback: [BoardingPolicyType::class, 'toArray'])]
	private ?string $boardingPolicy = null;

	/**
	 * The unique identifier for a flight including the airline IATA code. For example, if describing United flight 110, where the IATA code for United is 'UA', the flightNumber is 'UA110'.
	 *
	 * @see https://schema.org/flightNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/flightNumber'])]
	private ?string $flightNumber = null;

	/**
	 * An entity which offers (sells / leases / lends / loans) the services / goods. A seller may also be a provider.
	 *
	 * @see https://schema.org/seller
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/seller'])]
	#[Assert\NotNull]
	private Person $seller;

	/**
	 * The airport where the flight terminates.
	 *
	 * @see https://schema.org/arrivalAirport
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Airport')]
	#[ApiProperty(types: ['https://schema.org/arrivalAirport'])]
	private ?Airport $arrivalAirport = null;

	/**
	 * The airport where the flight originates.
	 *
	 * @see https://schema.org/departureAirport
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Airport')]
	#[ApiProperty(types: ['https://schema.org/departureAirport'])]
	private ?Airport $departureAirport = null;

	/**
	 * The distance of the flight.
	 *
	 * @see https://schema.org/flightDistance
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Distance')]
	#[ApiProperty(types: ['https://schema.org/flightDistance'])]
	private ?Distance $flightDistance = null;

	/**
	 * The kind of aircraft (e.g., "Boeing 747").
	 *
	 * @see https://schema.org/aircraft
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Vehicle')]
	#[ApiProperty(types: ['https://schema.org/aircraft'])]
	private ?Vehicle $aircraft = null;

	/**
	 * Identifier of the flight's departure gate.
	 *
	 * @see https://schema.org/departureGate
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/departureGate'])]
	private ?string $departureGate = null;

	/**
	 * Identifier of the flight's arrival terminal.
	 *
	 * @see https://schema.org/arrivalTerminal
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/arrivalTerminal'])]
	private ?string $arrivalTerminal = null;

	/**
	 * Identifier of the flight's departure terminal.
	 *
	 * @see https://schema.org/departureTerminal
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/departureTerminal'])]
	private ?string $departureTerminal = null;

	/**
	 * The estimated time the flight will take.
	 *
	 * @see https://schema.org/estimatedFlightDuration
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
	#[ApiProperty(types: ['https://schema.org/estimatedFlightDuration'])]
	private ?Duration $estimatedFlightDuration = null;

	/**
	 * Description of the meals that will be provided or available for purchase.
	 *
	 * @see https://schema.org/mealService
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/mealService'])]
	private ?string $mealService = null;

	/**
	 * The time when a passenger can check into the flight online.
	 *
	 * @see https://schema.org/webCheckinTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/webCheckinTime'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $webCheckinTime = null;

	public function setArrivalGate(?string $arrivalGate): void
	{
		$this->arrivalGate = $arrivalGate;
	}

	public function getArrivalGate(): ?string
	{
		return $this->arrivalGate;
	}

	public function setBoardingPolicy(?string $boardingPolicy): void
	{
		$this->boardingPolicy = $boardingPolicy;
	}

	public function getBoardingPolicy(): ?string
	{
		return $this->boardingPolicy;
	}

	public function setFlightNumber(?string $flightNumber): void
	{
		$this->flightNumber = $flightNumber;
	}

	public function getFlightNumber(): ?string
	{
		return $this->flightNumber;
	}

	public function setSeller(Person $seller): void
	{
		$this->seller = $seller;
	}

	public function getSeller(): Person
	{
		return $this->seller;
	}

	public function setArrivalAirport(?Airport $arrivalAirport): void
	{
		$this->arrivalAirport = $arrivalAirport;
	}

	public function getArrivalAirport(): ?Airport
	{
		return $this->arrivalAirport;
	}

	public function setDepartureAirport(?Airport $departureAirport): void
	{
		$this->departureAirport = $departureAirport;
	}

	public function getDepartureAirport(): ?Airport
	{
		return $this->departureAirport;
	}

	public function setFlightDistance(?Distance $flightDistance): void
	{
		$this->flightDistance = $flightDistance;
	}

	public function getFlightDistance(): ?Distance
	{
		return $this->flightDistance;
	}

	public function setAircraft(?Vehicle $aircraft): void
	{
		$this->aircraft = $aircraft;
	}

	public function getAircraft(): ?Vehicle
	{
		return $this->aircraft;
	}

	public function setDepartureGate(?string $departureGate): void
	{
		$this->departureGate = $departureGate;
	}

	public function getDepartureGate(): ?string
	{
		return $this->departureGate;
	}

	public function setArrivalTerminal(?string $arrivalTerminal): void
	{
		$this->arrivalTerminal = $arrivalTerminal;
	}

	public function getArrivalTerminal(): ?string
	{
		return $this->arrivalTerminal;
	}

	public function setDepartureTerminal(?string $departureTerminal): void
	{
		$this->departureTerminal = $departureTerminal;
	}

	public function getDepartureTerminal(): ?string
	{
		return $this->departureTerminal;
	}

	public function setEstimatedFlightDuration(?Duration $estimatedFlightDuration): void
	{
		$this->estimatedFlightDuration = $estimatedFlightDuration;
	}

	public function getEstimatedFlightDuration(): ?Duration
	{
		return $this->estimatedFlightDuration;
	}

	public function setMealService(?string $mealService): void
	{
		$this->mealService = $mealService;
	}

	public function getMealService(): ?string
	{
		return $this->mealService;
	}

	public function setWebCheckinTime(?\DateTimeInterface $webCheckinTime): void
	{
		$this->webCheckinTime = $webCheckinTime;
	}

	public function getWebCheckinTime(): ?\DateTimeInterface
	{
		return $this->webCheckinTime;
	}
}

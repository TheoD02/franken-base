<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A trip on a commercial bus line.
 *
 * @see https://schema.org/BusTrip
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BusTrip'])]
class BusTrip extends Trip
{
    /**
     * The stop or station from which the bus arrives.
     *
     * @see https://schema.org/arrivalBusStop
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\BusStation')]
    #[ApiProperty(types: ['https://schema.org/arrivalBusStop'])]
    private ?BusStation $arrivalBusStop = null;

    /**
     * The name of the bus (e.g. Bolt Express).
     *
     * @see https://schema.org/busName
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/busName'])]
    private ?string $busName = null;

    /**
     * The stop or station from which the bus departs.
     *
     * @see https://schema.org/departureBusStop
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\BusStation')]
    #[ApiProperty(types: ['https://schema.org/departureBusStop'])]
    private ?BusStation $departureBusStop = null;

    /**
     * The unique identifier for the bus.
     *
     * @see https://schema.org/busNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/busNumber'])]
    private ?string $busNumber = null;

    public function setArrivalBusStop(?BusStation $arrivalBusStop): void
    {
        $this->arrivalBusStop = $arrivalBusStop;
    }

    public function getArrivalBusStop(): ?BusStation
    {
        return $this->arrivalBusStop;
    }

    public function setBusName(?string $busName): void
    {
        $this->busName = $busName;
    }

    public function getBusName(): ?string
    {
        return $this->busName;
    }

    public function setDepartureBusStop(?BusStation $departureBusStop): void
    {
        $this->departureBusStop = $departureBusStop;
    }

    public function getDepartureBusStop(): ?BusStation
    {
        return $this->departureBusStop;
    }

    public function setBusNumber(?string $busNumber): void
    {
        $this->busNumber = $busNumber;
    }

    public function getBusNumber(): ?string
    {
        return $this->busNumber;
    }
}

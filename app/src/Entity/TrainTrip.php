<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A trip on a commercial train line.
 *
 * @see https://schema.org/TrainTrip
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TrainTrip'])]
class TrainTrip extends Trip
{
    /**
     * The unique identifier for the train.
     *
     * @see https://schema.org/trainNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/trainNumber'])]
    private ?string $trainNumber = null;

    /**
     * The platform from which the train departs.
     *
     * @see https://schema.org/departurePlatform
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/departurePlatform'])]
    private ?string $departurePlatform = null;

    /**
     * The station where the train trip ends.
     *
     * @see https://schema.org/arrivalStation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\TrainStation')]
    #[ApiProperty(types: ['https://schema.org/arrivalStation'])]
    private ?TrainStation $arrivalStation = null;

    /**
     * The station from which the train departs.
     *
     * @see https://schema.org/departureStation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\TrainStation')]
    #[ApiProperty(types: ['https://schema.org/departureStation'])]
    private ?TrainStation $departureStation = null;

    /**
     * The name of the train (e.g. The Orient Express).
     *
     * @see https://schema.org/trainName
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/trainName'])]
    private ?string $trainName = null;

    /**
     * The platform where the train arrives.
     *
     * @see https://schema.org/arrivalPlatform
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/arrivalPlatform'])]
    private ?string $arrivalPlatform = null;

    public function setTrainNumber(?string $trainNumber): void
    {
        $this->trainNumber = $trainNumber;
    }

    public function getTrainNumber(): ?string
    {
        return $this->trainNumber;
    }

    public function setDeparturePlatform(?string $departurePlatform): void
    {
        $this->departurePlatform = $departurePlatform;
    }

    public function getDeparturePlatform(): ?string
    {
        return $this->departurePlatform;
    }

    public function setArrivalStation(?TrainStation $arrivalStation): void
    {
        $this->arrivalStation = $arrivalStation;
    }

    public function getArrivalStation(): ?TrainStation
    {
        return $this->arrivalStation;
    }

    public function setDepartureStation(?TrainStation $departureStation): void
    {
        $this->departureStation = $departureStation;
    }

    public function getDepartureStation(): ?TrainStation
    {
        return $this->departureStation;
    }

    public function setTrainName(?string $trainName): void
    {
        $this->trainName = $trainName;
    }

    public function getTrainName(): ?string
    {
        return $this->trainName;
    }

    public function setArrivalPlatform(?string $arrivalPlatform): void
    {
        $this->arrivalPlatform = $arrivalPlatform;
    }

    public function getArrivalPlatform(): ?string
    {
        return $this->arrivalPlatform;
    }
}

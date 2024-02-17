<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A trip on a commercial ferry line.
 *
 * @see https://schema.org/BoatTrip
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BoatTrip'])]
class BoatTrip extends Trip
{
    /**
     * The terminal or port from which the boat departs.
     *
     * @see https://schema.org/departureBoatTerminal
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\BoatTerminal')]
    #[ApiProperty(types: ['https://schema.org/departureBoatTerminal'])]
    private ?BoatTerminal $departureBoatTerminal = null;

    /**
     * The terminal or port from which the boat arrives.
     *
     * @see https://schema.org/arrivalBoatTerminal
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\BoatTerminal')]
    #[ApiProperty(types: ['https://schema.org/arrivalBoatTerminal'])]
    private ?BoatTerminal $arrivalBoatTerminal = null;

    public function setDepartureBoatTerminal(?BoatTerminal $departureBoatTerminal): void
    {
        $this->departureBoatTerminal = $departureBoatTerminal;
    }

    public function getDepartureBoatTerminal(): ?BoatTerminal
    {
        return $this->departureBoatTerminal;
    }

    public function setArrivalBoatTerminal(?BoatTerminal $arrivalBoatTerminal): void
    {
        $this->arrivalBoatTerminal = $arrivalBoatTerminal;
    }

    public function getArrivalBoatTerminal(): ?BoatTerminal
    {
        return $this->arrivalBoatTerminal;
    }
}

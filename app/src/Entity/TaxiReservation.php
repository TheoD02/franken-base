<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A reservation for a taxi.\\n\\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations. For offers of tickets, use \[\[Offer\]\].
 *
 * @see https://schema.org/TaxiReservation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TaxiReservation'])]
class TaxiReservation extends Reservation
{
    /**
     * Number of people the reservation should accommodate.
     *
     * @see https://schema.org/partySize
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/partySize'])]
    #[Assert\NotNull]
    private QuantitativeValue $partySize;

    /**
     * Where a taxi will pick up a passenger or a rental car can be picked up.
     *
     * @see https://schema.org/pickupLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/pickupLocation'])]
    #[Assert\NotNull]
    private Place $pickupLocation;

    /**
     * When a taxi will pick up a passenger or a rental car can be picked up.
     *
     * @see https://schema.org/pickupTime
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\DateTime')]
    #[ApiProperty(types: ['https://schema.org/pickupTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $pickupTime = null;

    public function setPartySize(QuantitativeValue $partySize): void
    {
        $this->partySize = $partySize;
    }

    public function getPartySize(): QuantitativeValue
    {
        return $this->partySize;
    }

    public function setPickupLocation(Place $pickupLocation): void
    {
        $this->pickupLocation = $pickupLocation;
    }

    public function getPickupLocation(): Place
    {
        return $this->pickupLocation;
    }

    public function setPickupTime(?\DateTimeInterface $pickupTime): void
    {
        $this->pickupTime = $pickupTime;
    }

    public function getPickupTime(): ?\DateTimeInterface
    {
        return $this->pickupTime;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A reservation for a rental car.\\n\\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations.
 *
 * @see https://schema.org/RentalCarReservation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RentalCarReservation'])]
class RentalCarReservation extends Reservation
{
    /**
     * When a rental car can be dropped off.
     *
     * @see https://schema.org/dropoffTime
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\DateTime')]
    #[ApiProperty(types: ['https://schema.org/dropoffTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $dropoffTime = null;

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

    /**
     * Where a rental car can be dropped off.
     *
     * @see https://schema.org/dropoffLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/dropoffLocation'])]
    #[Assert\NotNull]
    private Place $dropoffLocation;

    public function setDropoffTime(?\DateTimeInterface $dropoffTime): void
    {
        $this->dropoffTime = $dropoffTime;
    }

    public function getDropoffTime(): ?\DateTimeInterface
    {
        return $this->dropoffTime;
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

    public function setDropoffLocation(Place $dropoffLocation): void
    {
        $this->dropoffLocation = $dropoffLocation;
    }

    public function getDropoffLocation(): Place
    {
        return $this->dropoffLocation;
    }
}

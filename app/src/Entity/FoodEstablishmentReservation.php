<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A reservation to dine at a food-related business.\\n\\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations.
 *
 * @see https://schema.org/FoodEstablishmentReservation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FoodEstablishmentReservation'])]
class FoodEstablishmentReservation extends Reservation
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
     * The endTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to end. For actions that span a period of time, when the action was performed. E.g. John wrote a book from January to \*December\*. For media, including audio and video, it's the time offset of the end of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
     *
     * @see https://schema.org/endTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/endTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $endTime = null;

    /**
     * The startTime of something. For a reserved event or service (e.g. FoodEstablishmentReservation), the time that it is expected to start. For actions that span a period of time, when the action was performed. E.g. John wrote a book from \*January\* to December. For media, including audio and video, it's the time offset of the start of a clip within a larger file.\\n\\nNote that Event uses startDate/endDate instead of startTime/endTime, even when describing dates with times. This situation may be clarified in future revisions.
     *
     * @see https://schema.org/startTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/startTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $startTime = null;

    public function setPartySize(QuantitativeValue $partySize): void
    {
        $this->partySize = $partySize;
    }

    public function getPartySize(): QuantitativeValue
    {
        return $this->partySize;
    }

    public function setEndTime(?\DateTimeInterface $endTime): void
    {
        $this->endTime = $endTime;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setStartTime(?\DateTimeInterface $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }
}

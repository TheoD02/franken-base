<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\QualitativeValue;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A reservation for lodging at a hotel, motel, inn, etc.\\n\\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations.
 *
 * @see https://schema.org/LodgingReservation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LodgingReservation'])]
class LodgingReservation extends Reservation
{
    /**
     * The number of children staying in the unit.
     *
     * @see https://schema.org/numChildren
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/numChildren'])]
    private ?int $numChildren = null;

    /**
     * The latest someone may check out of a lodging establishment.
     *
     * @see https://schema.org/checkoutTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
    #[ApiProperty(types: ['https://schema.org/checkoutTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $checkoutTime = null;

    /**
     * A full description of the lodging unit.
     *
     * @see https://schema.org/lodgingUnitDescription
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/lodgingUnitDescription'])]
    private ?string $lodgingUnitDescription = null;

    /**
     * Textual description of the unit type (including suite vs. room, size of bed, etc.).
     *
     * @see https://schema.org/lodgingUnitType
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/lodgingUnitType'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [QualitativeValue::class, 'toArray'])]
    private string $lodgingUnitType;

    /**
     * The number of adults staying in the unit.
     *
     * @see https://schema.org/numAdults
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/numAdults'])]
    private ?QuantitativeValue $numAdults = null;

    /**
     * The earliest someone may check into a lodging establishment.
     *
     * @see https://schema.org/checkinTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/checkinTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $checkinTime = null;

    public function setNumChildren(?int $numChildren): void
    {
        $this->numChildren = $numChildren;
    }

    public function getNumChildren(): ?int
    {
        return $this->numChildren;
    }

    public function setCheckoutTime(?\DateTimeInterface $checkoutTime): void
    {
        $this->checkoutTime = $checkoutTime;
    }

    public function getCheckoutTime(): ?\DateTimeInterface
    {
        return $this->checkoutTime;
    }

    public function setLodgingUnitDescription(?string $lodgingUnitDescription): void
    {
        $this->lodgingUnitDescription = $lodgingUnitDescription;
    }

    public function getLodgingUnitDescription(): ?string
    {
        return $this->lodgingUnitDescription;
    }

    public function setLodgingUnitType(string $lodgingUnitType): void
    {
        $this->lodgingUnitType = $lodgingUnitType;
    }

    public function getLodgingUnitType(): string
    {
        return $this->lodgingUnitType;
    }

    public function setNumAdults(?QuantitativeValue $numAdults): void
    {
        $this->numAdults = $numAdults;
    }

    public function getNumAdults(): ?QuantitativeValue
    {
        return $this->numAdults;
    }

    public function setCheckinTime(?\DateTimeInterface $checkinTime): void
    {
        $this->checkinTime = $checkinTime;
    }

    public function getCheckinTime(): ?\DateTimeInterface
    {
        return $this->checkinTime;
    }
}

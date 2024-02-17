<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Used to describe a seat, such as a reserved seat in an event reservation.
 *
 * @see https://schema.org/Seat
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Seat'])]
class Seat extends Intangible
{
    /**
     * The section location of the reserved seat (e.g. Orchestra).
     *
     * @see https://schema.org/seatSection
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/seatSection'])]
    private ?string $seatSection = null;

    /**
     * The type/class of the seat.
     *
     * @see https://schema.org/seatingType
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/seatingType'])]
    private ?string $seatingType = null;

    /**
     * The location of the reserved seat (e.g., 27).
     *
     * @see https://schema.org/seatNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/seatNumber'])]
    private ?string $seatNumber = null;

    /**
     * The row location of the reserved seat (e.g., B).
     *
     * @see https://schema.org/seatRow
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/seatRow'])]
    private ?string $seatRow = null;

    public function setSeatSection(?string $seatSection): void
    {
        $this->seatSection = $seatSection;
    }

    public function getSeatSection(): ?string
    {
        return $this->seatSection;
    }

    public function setSeatingType(?string $seatingType): void
    {
        $this->seatingType = $seatingType;
    }

    public function getSeatingType(): ?string
    {
        return $this->seatingType;
    }

    public function setSeatNumber(?string $seatNumber): void
    {
        $this->seatNumber = $seatNumber;
    }

    public function getSeatNumber(): ?string
    {
        return $this->seatNumber;
    }

    public function setSeatRow(?string $seatRow): void
    {
        $this->seatRow = $seatRow;
    }

    public function getSeatRow(): ?string
    {
        return $this->seatRow;
    }
}

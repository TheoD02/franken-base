<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\BoardingPolicyType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An organization that provides flights for passengers.
 *
 * @see https://schema.org/Airline
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Airline'])]
class Airline extends Organization
{
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
     * IATA identifier for an airline or airport.
     *
     * @see https://schema.org/iataCode
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/iataCode'])]
    private ?string $iataCode = null;

    public function setBoardingPolicy(?string $boardingPolicy): void
    {
        $this->boardingPolicy = $boardingPolicy;
    }

    public function getBoardingPolicy(): ?string
    {
        return $this->boardingPolicy;
    }

    public function setIataCode(?string $iataCode): void
    {
        $this->iataCode = $iataCode;
    }

    public function getIataCode(): ?string
    {
        return $this->iataCode;
    }
}

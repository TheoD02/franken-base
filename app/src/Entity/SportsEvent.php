<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Event type: Sports event.
 *
 * @see https://schema.org/SportsEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SportsEvent'])]
class SportsEvent extends Event
{
    /**
     * The away team in a sports event.
     *
     * @see https://schema.org/awayTeam
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/awayTeam'])]
    private ?Person $awayTeam = null;

    /**
     * A competitor in a sports event.
     *
     * @see https://schema.org/competitor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/competitor'])]
    #[Assert\NotNull]
    private Person $competitor;

    /**
     * A type of sport (e.g. Baseball).
     *
     * @see https://schema.org/sport
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/sport'])]
    private ?string $sport = null;

    /**
     * The home team in a sports event.
     *
     * @see https://schema.org/homeTeam
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/homeTeam'])]
    private ?Person $homeTeam = null;

    public function setAwayTeam(?Person $awayTeam): void
    {
        $this->awayTeam = $awayTeam;
    }

    public function getAwayTeam(): ?Person
    {
        return $this->awayTeam;
    }

    public function setCompetitor(Person $competitor): void
    {
        $this->competitor = $competitor;
    }

    public function getCompetitor(): Person
    {
        return $this->competitor;
    }

    public function setSport(?string $sport): void
    {
        $this->sport = $sport;
    }

    public function getSport(): ?string
    {
        return $this->sport;
    }

    public function setHomeTeam(?Person $homeTeam): void
    {
        $this->homeTeam = $homeTeam;
    }

    public function getHomeTeam(): ?Person
    {
        return $this->homeTeam;
    }
}

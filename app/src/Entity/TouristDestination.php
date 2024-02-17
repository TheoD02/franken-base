<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A tourist destination. In principle any \[\[Place\]\] can be a \[\[TouristDestination\]\] from a \[\[City\]\], Region or \[\[Country\]\] to an \[\[AmusementPark\]\] or \[\[Hotel\]\]. This Type can be used on its own to describe a general \[\[TouristDestination\]\], or be used as an \[\[additionalType\]\] to add tourist relevant properties to any other \[\[Place\]\]. A \[\[TouristDestination\]\] is defined as a \[\[Place\]\] that contains, or is colocated with, one or more \[\[TouristAttraction\]\]s, often linked by a similar theme or interest to a particular \[\[touristType\]\]. The \[UNWTO\](http://www2.unwto.org/) defines Destination (main destination of a tourism trip) as the place visited that is central to the decision to take the trip. (See examples below.).
 *
 * @see https://schema.org/TouristDestination
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TouristDestination'])]
class TouristDestination extends Place
{
    /**
     * Attraction located at destination.
     *
     * @see https://schema.org/includesAttraction
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\TouristAttraction')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/includesAttraction'])]
    #[Assert\NotNull]
    private TouristAttraction $includesAttraction;

    /**
     * @var Collection<Audience>|null Attraction suitable for type(s) of tourist. E.g. children, visitors from a particular country, etc.
     *
     * @see https://schema.org/touristType
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Audience')]
    #[ORM\JoinTable(name: 'tourist_destination_audience_tourist_type')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/touristType'])]
    private ?Collection $touristType = null;

    public function __construct()
    {
        parent::__construct();
        $this->touristType = new ArrayCollection();
    }

    public function setIncludesAttraction(TouristAttraction $includesAttraction): void
    {
        $this->includesAttraction = $includesAttraction;
    }

    public function getIncludesAttraction(): TouristAttraction
    {
        return $this->includesAttraction;
    }

    public function addTouristType(Audience $touristType): void
    {
        $this->touristType[] = $touristType;
    }

    public function removeTouristType(Audience $touristType): void
    {
        $this->touristType->removeElement($touristType);
    }

    /**
     * @return Collection<Audience>|null
     */
    public function getTouristType(): Collection
    {
        return $this->touristType;
    }
}

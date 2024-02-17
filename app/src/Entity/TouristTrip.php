<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * A tourist trip. A created itinerary of visits to one or more places of interest (\[\[TouristAttraction\]\]/\[\[TouristDestination\]\]) often linked by a similar theme, geographic area, or interest to a particular \[\[touristType\]\]. The \[UNWTO\](http://www2.unwto.org/) defines tourism trip as the Trip taken by visitors. (See examples below.).
 *
 * @see https://schema.org/TouristTrip
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TouristTrip'])]
class TouristTrip extends Trip
{
    /**
     * @var Collection<Audience>|null Attraction suitable for type(s) of tourist. E.g. children, visitors from a particular country, etc.
     *
     * @see https://schema.org/touristType
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Audience')]
    #[ORM\JoinTable(name: 'tourist_trip_audience_tourist_type')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/touristType'])]
    private ?Collection $touristType = null;

    public function __construct()
    {
        parent::__construct();
        $this->touristType = new ArrayCollection();
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

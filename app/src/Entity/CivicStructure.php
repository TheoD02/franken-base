<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * A public structure, such as a town hall or concert hall.
 *
 * @see https://schema.org/CivicStructure
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'civicStructure' => CivicStructure::class,
    'park' => Park::class,
    'taxiStand' => TaxiStand::class,
    'stadiumOrArena' => StadiumOrArena::class,
    'publicToilet' => PublicToilet::class,
    'subwayStation' => SubwayStation::class,
    'playground' => Playground::class,
    'zoo' => Zoo::class,
    'aquarium' => Aquarium::class,
    'bridge' => Bridge::class,
    'musicVenue' => MusicVenue::class,
    'cemetery' => Cemetery::class,
    'performingArtsTheater' => PerformingArtsTheater::class,
    'parkingFacility' => ParkingFacility::class,
    'eventVenue' => EventVenue::class,
    'crematorium' => Crematorium::class,
    'RVPark' => RVPark::class,
    'museum' => Museum::class,
    'beach' => Beach::class,
    'boatTerminal' => BoatTerminal::class,
    'trainStation' => TrainStation::class,
    'busStop' => BusStop::class,
    'airport' => Airport::class,
    'busStation' => BusStation::class,
    'cityHall' => CityHall::class,
    'courthouse' => Courthouse::class,
    'legislativeBuilding' => LegislativeBuilding::class,
    'defenceEstablishment' => DefenceEstablishment::class,
    'embassy' => Embassy::class,
    'synagogue' => Synagogue::class,
    'mosque' => Mosque::class,
    'hinduTemple' => HinduTemple::class,
    'buddhistTemple' => BuddhistTemple::class,
    'catholicChurch' => CatholicChurch::class,
])]
class CivicStructure extends Place
{
    /**
     * The general opening hours for a business. Opening hours can be specified as a weekly time range, starting with days, then times per day. Multiple days can be listed with commas ',' separating each day. Day or time ranges are specified using a hyphen '-'.\\n\\n\* Days are specified using the following two-letter combinations: ```Mo```, ```Tu```, ```We```, ```Th```, ```Fr```, ```Sa```, ```Su```.\\n\* Times are specified using 24:00 format. For example, 3pm is specified as ```15:00```, 10am as ```10:00```. \\n\* Here is an example: `<time itemprop="openingHours" datetime="Tu,Th 16:00-20:00">Tuesdays and Thursdays 4-8pm</time>`.\\n\* If a business is open 7 days a week, then it can be specified as `<time itemprop="openingHours" datetime="Mo-Su">Monday through Sunday, all day</time>`.
     *
     * @see https://schema.org/openingHours
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/openingHours'])]
    private ?string $openingHours = null;

    public function setOpeningHours(?string $openingHours): void
    {
        $this->openingHours = $openingHours;
    }

    public function getOpeningHours(): ?string
    {
        return $this->openingHours;
    }
}

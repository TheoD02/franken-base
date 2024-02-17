<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A business providing entertainment.
 *
 * @see https://schema.org/EntertainmentBusiness
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'entertainmentBusiness' => EntertainmentBusiness::class,
    'comedyClub' => ComedyClub::class,
    'artGallery' => ArtGallery::class,
    'nightClub' => NightClub::class,
    'casino' => Casino::class,
    'amusementPark' => AmusementPark::class,
    'adultEntertainment' => AdultEntertainment::class,
    'movieTheater' => MovieTheater::class,
])]
class EntertainmentBusiness extends LocalBusiness
{
}

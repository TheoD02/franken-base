<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A sports location, such as a playing field.
 *
 * @see https://schema.org/SportsActivityLocation
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'sportsActivityLocation' => SportsActivityLocation::class,
    'bowlingAlley' => BowlingAlley::class,
    'golfCourse' => GolfCourse::class,
    'publicSwimmingPool' => PublicSwimmingPool::class,
    'skiResort' => SkiResort::class,
    'exerciseGym' => ExerciseGym::class,
    'sportsClub' => SportsClub::class,
    'tennisComplex' => TennisComplex::class,
])]
class SportsActivityLocation extends LocalBusiness
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A geographical region, typically under the jurisdiction of a particular government.
 *
 * @see https://schema.org/AdministrativeArea
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'administrativeArea' => AdministrativeArea::class,
    'schoolDistrict' => SchoolDistrict::class,
    'city' => City::class,
    'state' => State::class,
    'country' => Country::class,
])]
class AdministrativeArea extends Place
{
}

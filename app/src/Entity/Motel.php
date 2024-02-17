<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A motel.
 *
 * See also the [dedicated document on the use of schema.org for marking up hotels and other forms of accommodations](/docs/hotels.html).
 *
 * @see https://schema.org/Motel
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Motel'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'numberOfRooms',
        joinTable: new ORM\JoinTable(name: 'lodging_business_number_number_of_rooms_motel'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class Motel extends LodgingBusiness
{
}

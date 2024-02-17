<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A hostel - cheap accommodation, often in shared dormitories.
 *
 * See also the [dedicated document on the use of schema.org for marking up hotels and other forms of accommodations](/docs/hotels.html).
 *
 * @see https://schema.org/Hostel
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Hostel'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'numberOfRooms',
        joinTable: new ORM\JoinTable(name: 'lodging_business_number_number_of_rooms_hostel'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class Hostel extends LodgingBusiness
{
}

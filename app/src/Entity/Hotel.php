<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A hotel is an establishment that provides lodging paid on a short-term basis (source: Wikipedia, the free encyclopedia, see http://en.wikipedia.org/wiki/Hotel).
 *
 * See also the [dedicated document on the use of schema.org for marking up hotels and other forms of accommodations](/docs/hotels.html).
 *
 * @see https://schema.org/Hotel
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Hotel'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'numberOfRooms',
        joinTable: new ORM\JoinTable(name: 'lodging_business_number_number_of_rooms_hotel'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class Hotel extends LodgingBusiness
{
}

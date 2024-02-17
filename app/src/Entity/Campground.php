<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A camping site, campsite, or \[\[Campground\]\] is a place used for overnight stay in the outdoors, typically containing individual \[\[CampingPitch\]\] locations. \\n\\n In British English a campsite is an area, usually divided into a number of pitches, where people can camp overnight using tents or camper vans or caravans; this British English use of the word is synonymous with the American English expression campground. In American English the term campsite generally means an area where an individual, family, group, or military unit can pitch a tent or park a camper; a campground may contain many campsites (source: Wikipedia, see \[https://en.wikipedia.org/wiki/Campsite\](https://en.wikipedia.org/wiki/Campsite)).\\n\\n See also the dedicated \[document on the use of schema.org for marking up hotels and other forms of accommodations\](/docs/hotels.html).
 *
 * @see https://schema.org/Campground
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Campground'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'numberOfRooms',
        joinTable: new ORM\JoinTable(name: 'lodging_business_number_number_of_rooms_campground'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class Campground extends LodgingBusiness
{
}

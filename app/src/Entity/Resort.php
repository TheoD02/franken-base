<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A resort is a place used for relaxation or recreation, attracting visitors for holidays or vacations. Resorts are places, towns or sometimes commercial establishments operated by a single company (source: Wikipedia, the free encyclopedia, see <http://en.wikipedia.org/wiki/Resort>).
 *
 * See also the [dedicated document on the use of schema.org for marking up hotels and other forms of accommodations](/docs/hotels.html).
 *
 * @see https://schema.org/Resort
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Resort'])]
#[ORM\AssociationOverrides([
	new ORM\AssociationOverride(
		name: 'numberOfRooms',
		joinTable: new ORM\JoinTable(name: 'lodging_business_number_number_of_rooms_resort'),
		joinColumns: [new ORM\JoinColumn()],
		inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
	),
])]
class Resort extends LodgingBusiness
{
}

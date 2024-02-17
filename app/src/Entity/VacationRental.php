<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A kind of lodging business that focuses on renting single properties for limited time.
 *
 * @see https://schema.org/VacationRental
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VacationRental'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'numberOfRooms',
        joinTable: new ORM\JoinTable(name: 'lodging_business_number_number_of_rooms_vacation_rental'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class VacationRental extends LodgingBusiness
{
}

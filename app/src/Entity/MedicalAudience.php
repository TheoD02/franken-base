<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Target audiences for medical web pages.
 *
 * @see https://schema.org/MedicalAudience
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalAudience'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'healthCondition',
        joinTable: new ORM\JoinTable(name: 'join_table_67a51a3f'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class MedicalAudience extends PeopleAudience
{
}

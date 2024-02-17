<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A program with both an educational and employment component. Typically based at a workplace and structured around work-based learning, with the aim of instilling competencies related to an occupation. WorkBasedProgram is used to distinguish programs such as apprenticeships from school, college or other classroom based educational programs.
 *
 * @see https://schema.org/WorkBasedProgram
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WorkBasedProgram'])]
#[ORM\AssociationOverrides([
    new ORM\AssociationOverride(
        name: 'termDuration',
        joinTable: new ORM\JoinTable(name: 'join_table_214c1d3d'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
    new ORM\AssociationOverride(
        name: 'offers',
        joinTable: new ORM\JoinTable(name: 'join_table_217f1948'),
        joinColumns: [new ORM\JoinColumn()],
        inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
    ),
])]
class WorkBasedProgram extends EducationalOccupationalProgram
{
}

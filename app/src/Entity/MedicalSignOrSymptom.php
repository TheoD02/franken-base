<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Any feature associated or not with a medical condition. In medicine a symptom is generally subjective while a sign is objective.
 *
 * @see https://schema.org/MedicalSignOrSymptom
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'medicalSignOrSymptom' => MedicalSignOrSymptom::class,
    'medicalSymptom' => MedicalSymptom::class,
    'medicalSign' => MedicalSign::class,
    'vitalSign' => VitalSign::class,
])]
class MedicalSignOrSymptom extends MedicalCondition
{
}

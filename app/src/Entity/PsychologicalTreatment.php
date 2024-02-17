<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A process of care relying upon counseling, dialogue and communication aimed at improving a mental health condition without use of drugs.
 *
 * @see https://schema.org/PsychologicalTreatment
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PsychologicalTreatment'])]
class PsychologicalTreatment extends TherapeuticProcedure
{
}

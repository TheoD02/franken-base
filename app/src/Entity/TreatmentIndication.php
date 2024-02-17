<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An indication for treating an underlying condition, symptom, etc.
 *
 * @see https://schema.org/TreatmentIndication
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TreatmentIndication'])]
class TreatmentIndication extends MedicalIndication
{
}

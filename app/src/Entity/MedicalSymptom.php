<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Any complaint sensed and expressed by the patient (therefore defined as subjective) like stomachache, lower-back pain, or fatigue.
 *
 * @see https://schema.org/MedicalSymptom
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MedicalSymptom'])]
class MedicalSymptom extends MedicalSignOrSymptom
{
}

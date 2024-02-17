<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A treatment of people with physical, emotional, or social problems, using purposeful activity to help them overcome or learn to deal with their problems.
 *
 * @see https://schema.org/OccupationalTherapy
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OccupationalTherapy'])]
class OccupationalTherapy extends MedicalTherapy
{
}

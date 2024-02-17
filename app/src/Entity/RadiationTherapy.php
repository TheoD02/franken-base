<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A process of care using radiation aimed at improving a health condition.
 *
 * @see https://schema.org/RadiationTherapy
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RadiationTherapy'])]
class RadiationTherapy extends MedicalTherapy
{
}

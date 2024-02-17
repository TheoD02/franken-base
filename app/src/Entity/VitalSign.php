<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vital signs are measures of various physiological functions in order to assess the most basic body functions.
 *
 * @see https://schema.org/VitalSign
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VitalSign'])]
class VitalSign extends MedicalSign
{
}

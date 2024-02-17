<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A medical procedure intended primarily for palliative purposes, aimed at relieving the symptoms of an underlying health condition.
 *
 * @see https://schema.org/PalliativeProcedure
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PalliativeProcedure'])]
class PalliativeProcedure extends MedicalTherapy
{
}

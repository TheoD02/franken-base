<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A process of progressive physical care and rehabilitation aimed at improving a health condition.
 *
 * @see https://schema.org/PhysicalTherapy
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PhysicalTherapy'])]
class PhysicalTherapy extends MedicalTherapy
{
}

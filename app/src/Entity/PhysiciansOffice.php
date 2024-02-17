<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A doctor's office or clinic.
 *
 * @see https://schema.org/PhysiciansOffice
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PhysiciansOffice'])]
class PhysiciansOffice extends Physician
{
}

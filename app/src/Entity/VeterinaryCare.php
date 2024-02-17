<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A vet's office.
 *
 * @see https://schema.org/VeterinaryCare
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VeterinaryCare'])]
class VeterinaryCare extends MedicalOrganization
{
}

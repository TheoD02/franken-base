<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A pharmacy or drugstore.
 *
 * @see https://schema.org/Pharmacy
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Pharmacy'])]
class Pharmacy extends MedicalOrganization
{
}

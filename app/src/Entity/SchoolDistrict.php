<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A School District is an administrative area for the administration of schools.
 *
 * @see https://schema.org/SchoolDistrict
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SchoolDistrict'])]
class SchoolDistrict extends AdministrativeArea
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A college, university, or other third-level educational institution.
 *
 * @see https://schema.org/CollegeOrUniversity
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CollegeOrUniversity'])]
class CollegeOrUniversity extends EducationalOrganization
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A high school.
 *
 * @see https://schema.org/HighSchool
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HighSchool'])]
class HighSchool extends EducationalOrganization
{
}

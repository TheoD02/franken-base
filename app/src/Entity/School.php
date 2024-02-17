<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A school.
 *
 * @see https://schema.org/School
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/School'])]
class School extends EducationalOrganization
{
}

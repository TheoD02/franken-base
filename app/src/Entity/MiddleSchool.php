<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A middle school (typically for children aged around 11-14, although this varies somewhat).
 *
 * @see https://schema.org/MiddleSchool
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MiddleSchool'])]
class MiddleSchool extends EducationalOrganization
{
}

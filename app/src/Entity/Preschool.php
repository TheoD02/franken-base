<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A preschool.
 *
 * @see https://schema.org/Preschool
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Preschool'])]
class Preschool extends EducationalOrganization
{
}

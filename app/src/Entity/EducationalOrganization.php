<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * An educational organization.
 *
 * @see https://schema.org/EducationalOrganization
 */
#[ORM\MappedSuperclass]
abstract class EducationalOrganization extends Organization
{
}

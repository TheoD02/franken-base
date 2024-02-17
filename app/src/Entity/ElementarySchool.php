<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An elementary school.
 *
 * @see https://schema.org/ElementarySchool
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ElementarySchool'])]
class ElementarySchool extends EducationalOrganization
{
}

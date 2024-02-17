<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An employment agency.
 *
 * @see https://schema.org/EmploymentAgency
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EmploymentAgency'])]
class EmploymentAgency extends LocalBusiness
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A governmental organization or agency.
 *
 * @see https://schema.org/GovernmentOrganization
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GovernmentOrganization'])]
class GovernmentOrganization extends Organization
{
}

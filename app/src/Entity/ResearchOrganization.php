<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Research Organization (e.g. scientific institute, research company).
 *
 * @see https://schema.org/ResearchOrganization
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ResearchOrganization'])]
class ResearchOrganization extends Organization
{
}

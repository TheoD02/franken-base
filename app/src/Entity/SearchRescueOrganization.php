<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Search and Rescue organization of some kind.
 *
 * @see https://schema.org/SearchRescueOrganization
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SearchRescueOrganization'])]
class SearchRescueOrganization extends Organization
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Organization: Political Party.
 *
 * @see https://schema.org/PoliticalParty
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PoliticalParty'])]
class PoliticalParty extends Organization
{
}

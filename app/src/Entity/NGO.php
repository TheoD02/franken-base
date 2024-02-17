<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Organization: Non-governmental Organization.
 *
 * @see https://schema.org/NGO
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/NGO'])]
class NGO extends Organization
{
}

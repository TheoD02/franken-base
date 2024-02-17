<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Beach.
 *
 * @see https://schema.org/Beach
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Beach'])]
class Beach extends CivicStructure
{
}

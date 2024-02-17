<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A park.
 *
 * @see https://schema.org/Park
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Park'])]
class Park extends CivicStructure
{
}

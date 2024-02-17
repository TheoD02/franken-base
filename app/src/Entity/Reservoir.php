<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A reservoir of water, typically an artificially created lake, like the Lake Kariba reservoir.
 *
 * @see https://schema.org/Reservoir
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Reservoir'])]
class Reservoir extends BodyOfWater
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A river (for example, the broad majestic Shannon).
 *
 * @see https://schema.org/RiverBodyOfWater
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RiverBodyOfWater'])]
class RiverBodyOfWater extends BodyOfWater
{
}

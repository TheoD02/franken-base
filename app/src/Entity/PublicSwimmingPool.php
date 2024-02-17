<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A public swimming pool.
 *
 * @see https://schema.org/PublicSwimmingPool
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PublicSwimmingPool'])]
class PublicSwimmingPool extends SportsActivityLocation
{
}

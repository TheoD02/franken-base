<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A bowling alley.
 *
 * @see https://schema.org/BowlingAlley
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BowlingAlley'])]
class BowlingAlley extends SportsActivityLocation
{
}

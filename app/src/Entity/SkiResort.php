<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A ski resort.
 *
 * @see https://schema.org/SkiResort
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SkiResort'])]
class SkiResort extends SportsActivityLocation
{
}

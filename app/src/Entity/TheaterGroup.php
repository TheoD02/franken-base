<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A theater group or company, for example, the Royal Shakespeare Company or Druid Theatre.
 *
 * @see https://schema.org/TheaterGroup
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TheaterGroup'])]
class TheaterGroup extends PerformingGroup
{
}

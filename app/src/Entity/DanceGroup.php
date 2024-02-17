<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A dance group—for example, the Alvin Ailey Dance Theater or Riverdance.
 *
 * @see https://schema.org/DanceGroup
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DanceGroup'])]
class DanceGroup extends PerformingGroup
{
}

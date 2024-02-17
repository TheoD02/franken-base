<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A bus stop.
 *
 * @see https://schema.org/BusStop
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BusStop'])]
class BusStop extends CivicStructure
{
}

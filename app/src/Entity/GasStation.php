<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A gas station.
 *
 * @see https://schema.org/GasStation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GasStation'])]
class GasStation extends AutomotiveBusiness
{
}

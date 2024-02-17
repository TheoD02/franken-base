<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A unique instance of a television BroadcastService on a CableOrSatelliteService lineup.
 *
 * @see https://schema.org/TelevisionChannel
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TelevisionChannel'])]
class TelevisionChannel extends BroadcastChannel
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A unique instance of a radio BroadcastService on a CableOrSatelliteService lineup.
 *
 * @see https://schema.org/RadioChannel
 */
#[ORM\MappedSuperclass]
abstract class RadioChannel extends BroadcastChannel
{
}

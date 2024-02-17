<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A train station.
 *
 * @see https://schema.org/TrainStation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TrainStation'])]
class TrainStation extends CivicStructure
{
}

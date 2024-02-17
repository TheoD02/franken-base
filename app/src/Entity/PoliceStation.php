<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A police station.
 *
 * @see https://schema.org/PoliceStation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PoliceStation'])]
class PoliceStation extends EmergencyService
{
}

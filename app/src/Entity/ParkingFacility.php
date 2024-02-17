<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A parking lot or other parking facility.
 *
 * @see https://schema.org/ParkingFacility
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ParkingFacility'])]
class ParkingFacility extends CivicStructure
{
}

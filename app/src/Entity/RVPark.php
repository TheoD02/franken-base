<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A place offering space for "Recreational Vehicles", Caravans, mobile homes and the like.
 *
 * @see https://schema.org/RVPark
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RVPark'])]
class RVPark extends CivicStructure
{
}

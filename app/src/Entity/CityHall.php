<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A city hall.
 *
 * @see https://schema.org/CityHall
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CityHall'])]
class CityHall extends GovernmentBuilding
{
}

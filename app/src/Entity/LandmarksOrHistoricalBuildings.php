<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An historical landmark or building.
 *
 * @see https://schema.org/LandmarksOrHistoricalBuildings
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LandmarksOrHistoricalBuildings'])]
class LandmarksOrHistoricalBuildings extends Place
{
}

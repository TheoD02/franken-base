<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A subway station.
 *
 * @see https://schema.org/SubwayStation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SubwayStation'])]
class SubwayStation extends CivicStructure
{
}

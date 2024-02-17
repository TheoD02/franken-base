<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An ocean (for example, the Pacific).
 *
 * @see https://schema.org/OceanBodyOfWater
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OceanBodyOfWater'])]
class OceanBodyOfWater extends BodyOfWater
{
}

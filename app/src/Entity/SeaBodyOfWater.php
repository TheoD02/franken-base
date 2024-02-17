<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A sea (for example, the Caspian sea).
 *
 * @see https://schema.org/SeaBodyOfWater
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SeaBodyOfWater'])]
class SeaBodyOfWater extends BodyOfWater
{
}

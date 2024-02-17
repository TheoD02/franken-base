<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A waterfall, like Niagara.
 *
 * @see https://schema.org/Waterfall
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Waterfall'])]
class Waterfall extends BodyOfWater
{
}

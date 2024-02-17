<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Hindu temple.
 *
 * @see https://schema.org/HinduTemple
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HinduTemple'])]
class HinduTemple extends PlaceOfWorship
{
}

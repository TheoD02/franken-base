<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Buddhist temple.
 *
 * @see https://schema.org/BuddhistTemple
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BuddhistTemple'])]
class BuddhistTemple extends PlaceOfWorship
{
}

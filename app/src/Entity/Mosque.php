<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A mosque.
 *
 * @see https://schema.org/Mosque
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Mosque'])]
class Mosque extends PlaceOfWorship
{
}

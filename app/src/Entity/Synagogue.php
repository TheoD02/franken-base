<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A synagogue.
 *
 * @see https://schema.org/Synagogue
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Synagogue'])]
class Synagogue extends PlaceOfWorship
{
}

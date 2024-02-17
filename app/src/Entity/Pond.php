<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A pond.
 *
 * @see https://schema.org/Pond
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Pond'])]
class Pond extends BodyOfWater
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A canal, like the Panama Canal.
 *
 * @see https://schema.org/Canal
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Canal'])]
class Canal extends BodyOfWater
{
}

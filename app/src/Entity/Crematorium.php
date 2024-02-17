<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A crematorium.
 *
 * @see https://schema.org/Crematorium
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Crematorium'])]
class Crematorium extends CivicStructure
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A short TV program or a segment/part of a TV program.
 *
 * @see https://schema.org/TVClip
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TVClip'])]
class TVClip extends Clip
{
}

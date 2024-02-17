<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A short radio program or a segment/part of a radio program.
 *
 * @see https://schema.org/RadioClip
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RadioClip'])]
class RadioClip extends Clip
{
}

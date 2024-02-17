<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A short segment/part of a video game.
 *
 * @see https://schema.org/VideoGameClip
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VideoGameClip'])]
class VideoGameClip extends Clip
{
}

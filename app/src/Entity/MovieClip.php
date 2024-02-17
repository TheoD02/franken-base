<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A short segment/part of a movie.
 *
 * @see https://schema.org/MovieClip
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MovieClip'])]
class MovieClip extends Clip
{
}

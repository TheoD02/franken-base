<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The artwork on the cover of a comic.
 *
 * @see https://schema.org/ComicCoverArt
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ComicCoverArt'])]
class ComicCoverArt extends CoverArt
{
}

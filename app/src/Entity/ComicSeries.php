<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A sequential publication of comic stories under a unifying title, for example "The Amazing Spider-Man" or "Groo the Wanderer".
 *
 * @see https://schema.org/ComicSeries
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ComicSeries'])]
class ComicSeries extends Periodical
{
}

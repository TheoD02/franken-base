<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A single season of a podcast. Many podcasts do not break down into separate seasons. In that case, PodcastSeries should be used.
 *
 * @see https://schema.org/PodcastSeason
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PodcastSeason'])]
class PodcastSeason extends CreativeWorkSeason
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A single episode of a podcast series.
 *
 * @see https://schema.org/PodcastEpisode
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PodcastEpisode'])]
class PodcastEpisode extends Episode
{
}

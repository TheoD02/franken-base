<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A radio episode which can be part of a series or season.
 *
 * @see https://schema.org/RadioEpisode
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RadioEpisode'])]
class RadioEpisode extends Episode
{
}

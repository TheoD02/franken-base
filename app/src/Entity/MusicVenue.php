<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A music venue.
 *
 * @see https://schema.org/MusicVenue
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MusicVenue'])]
class MusicVenue extends CivicStructure
{
}

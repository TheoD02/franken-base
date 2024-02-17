<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A music video file.
 *
 * @see https://schema.org/MusicVideoObject
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MusicVideoObject'])]
class MusicVideoObject extends MediaObject
{
}

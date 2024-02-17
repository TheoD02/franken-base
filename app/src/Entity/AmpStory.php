<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A creative work with a visual storytelling format intended to be viewed online, particularly on mobile devices.
 *
 * @see https://schema.org/AmpStory
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AmpStory'])]
class AmpStory extends MediaObject
{
}

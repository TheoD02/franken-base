<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Short story or tale. A brief work of literature, usually written in narrative prose.
 *
 * @see https://schema.org/ShortStory
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ShortStory'])]
class ShortStory extends CreativeWork
{
}

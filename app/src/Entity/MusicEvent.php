<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Music event.
 *
 * @see https://schema.org/MusicEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MusicEvent'])]
class MusicEvent extends Event
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Theater performance.
 *
 * @see https://schema.org/TheaterEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TheaterEvent'])]
class TheaterEvent extends Event
{
}

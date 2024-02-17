<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: A social dance.
 *
 * @see https://schema.org/DanceEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DanceEvent'])]
class DanceEvent extends Event
{
}

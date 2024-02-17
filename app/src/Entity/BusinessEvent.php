<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Business event.
 *
 * @see https://schema.org/BusinessEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BusinessEvent'])]
class BusinessEvent extends Event
{
}

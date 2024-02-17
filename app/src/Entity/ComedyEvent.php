<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Comedy event.
 *
 * @see https://schema.org/ComedyEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ComedyEvent'])]
class ComedyEvent extends Event
{
}

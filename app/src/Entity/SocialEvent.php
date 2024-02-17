<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Social event.
 *
 * @see https://schema.org/SocialEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SocialEvent'])]
class SocialEvent extends Event
{
}

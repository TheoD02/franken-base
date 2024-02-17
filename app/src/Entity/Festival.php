<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Festival.
 *
 * @see https://schema.org/Festival
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Festival'])]
class Festival extends Event
{
}

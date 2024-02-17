<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Visual arts event.
 *
 * @see https://schema.org/VisualArtsEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VisualArtsEvent'])]
class VisualArtsEvent extends Event
{
}

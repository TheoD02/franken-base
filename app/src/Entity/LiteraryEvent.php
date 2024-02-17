<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Literary event.
 *
 * @see https://schema.org/LiteraryEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LiteraryEvent'])]
class LiteraryEvent extends Event
{
}

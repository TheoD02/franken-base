<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Children's event.
 *
 * @see https://schema.org/ChildrensEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ChildrensEvent'])]
class ChildrensEvent extends Event
{
}

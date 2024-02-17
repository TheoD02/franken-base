<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of arriving at a place. An agent arrives at a destination from a fromLocation, optionally with participants.
 *
 * @see https://schema.org/ArriveAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ArriveAction'])]
class ArriveAction extends MoveAction
{
}

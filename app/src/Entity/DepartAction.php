<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of departing from a place. An agent departs from a fromLocation for a destination, optionally with participants.
 *
 * @see https://schema.org/DepartAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DepartAction'])]
class DepartAction extends MoveAction
{
}

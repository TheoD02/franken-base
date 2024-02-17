<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A terminal for boats, ships, and other water vessels.
 *
 * @see https://schema.org/BoatTerminal
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BoatTerminal'])]
class BoatTerminal extends CivicStructure
{
}

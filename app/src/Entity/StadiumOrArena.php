<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A stadium.
 *
 * @see https://schema.org/StadiumOrArena
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/StadiumOrArena'])]
class StadiumOrArena extends CivicStructure
{
}

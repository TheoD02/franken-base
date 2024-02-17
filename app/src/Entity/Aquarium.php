<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Aquarium.
 *
 * @see https://schema.org/Aquarium
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Aquarium'])]
class Aquarium extends CivicStructure
{
}

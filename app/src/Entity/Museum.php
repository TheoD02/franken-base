<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A museum.
 *
 * @see https://schema.org/Museum
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Museum'])]
class Museum extends CivicStructure
{
}

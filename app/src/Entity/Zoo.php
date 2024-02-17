<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A zoo.
 *
 * @see https://schema.org/Zoo
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Zoo'])]
class Zoo extends CivicStructure
{
}

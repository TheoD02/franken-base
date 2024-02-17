<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A playground.
 *
 * @see https://schema.org/Playground
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Playground'])]
class Playground extends CivicStructure
{
}

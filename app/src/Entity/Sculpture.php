<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A piece of sculpture.
 *
 * @see https://schema.org/Sculpture
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Sculpture'])]
class Sculpture extends CreativeWork
{
}

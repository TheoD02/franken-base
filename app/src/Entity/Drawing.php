<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A picture or diagram made with a pencil, pen, or crayon rather than paint.
 *
 * @see https://schema.org/Drawing
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Drawing'])]
class Drawing extends CreativeWork
{
}

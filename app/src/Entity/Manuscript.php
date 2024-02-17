<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A book, document, or piece of music written by hand rather than typed or printed.
 *
 * @see https://schema.org/Manuscript
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Manuscript'])]
class Manuscript extends CreativeWork
{
}

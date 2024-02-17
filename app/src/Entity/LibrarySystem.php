<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A \[\[LibrarySystem\]\] is a collaborative system amongst several libraries.
 *
 * @see https://schema.org/LibrarySystem
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LibrarySystem'])]
class LibrarySystem extends Organization
{
}

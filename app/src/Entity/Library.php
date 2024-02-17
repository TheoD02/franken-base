<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A library.
 *
 * @see https://schema.org/Library
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Library'])]
class Library extends LocalBusiness
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A toy store.
 *
 * @see https://schema.org/ToyStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ToyStore'])]
class ToyStore extends Store
{
}

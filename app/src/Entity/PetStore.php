<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A pet store.
 *
 * @see https://schema.org/PetStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PetStore'])]
class PetStore extends Store
{
}

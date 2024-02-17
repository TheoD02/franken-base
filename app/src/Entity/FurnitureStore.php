<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A furniture store.
 *
 * @see https://schema.org/FurnitureStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FurnitureStore'])]
class FurnitureStore extends Store
{
}

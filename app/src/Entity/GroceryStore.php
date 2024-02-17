<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A grocery store.
 *
 * @see https://schema.org/GroceryStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GroceryStore'])]
class GroceryStore extends Store
{
}

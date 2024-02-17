<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A men's clothing store.
 *
 * @see https://schema.org/MensClothingStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MensClothingStore'])]
class MensClothingStore extends Store
{
}

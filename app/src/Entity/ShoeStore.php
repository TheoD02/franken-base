<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A shoe store.
 *
 * @see https://schema.org/ShoeStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ShoeStore'])]
class ShoeStore extends Store
{
}

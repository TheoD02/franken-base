<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A jewelry store.
 *
 * @see https://schema.org/JewelryStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/JewelryStore'])]
class JewelryStore extends Store
{
}

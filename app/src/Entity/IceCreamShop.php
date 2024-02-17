<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An ice cream shop.
 *
 * @see https://schema.org/IceCreamShop
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/IceCreamShop'])]
class IceCreamShop extends FoodEstablishment
{
}

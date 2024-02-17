<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A cafe or coffee shop.
 *
 * @see https://schema.org/CafeOrCoffeeShop
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CafeOrCoffeeShop'])]
class CafeOrCoffeeShop extends FoodEstablishment
{
}

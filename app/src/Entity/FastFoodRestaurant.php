<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A fast-food restaurant.
 *
 * @see https://schema.org/FastFoodRestaurant
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FastFoodRestaurant'])]
class FastFoodRestaurant extends FoodEstablishment
{
}

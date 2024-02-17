<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A restaurant.
 *
 * @see https://schema.org/Restaurant
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Restaurant'])]
class Restaurant extends FoodEstablishment
{
}

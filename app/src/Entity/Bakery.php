<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A bakery.
 *
 * @see https://schema.org/Bakery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Bakery'])]
class Bakery extends FoodEstablishment
{
}

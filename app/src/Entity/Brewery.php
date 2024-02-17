<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Brewery.
 *
 * @see https://schema.org/Brewery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Brewery'])]
class Brewery extends FoodEstablishment
{
}

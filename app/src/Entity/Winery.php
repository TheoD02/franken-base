<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A winery.
 *
 * @see https://schema.org/Winery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Winery'])]
class Winery extends FoodEstablishment
{
}

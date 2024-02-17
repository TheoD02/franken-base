<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A tire shop.
 *
 * @see https://schema.org/TireShop
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TireShop'])]
class TireShop extends Store
{
}

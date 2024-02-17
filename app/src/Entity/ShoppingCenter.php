<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A shopping center or mall.
 *
 * @see https://schema.org/ShoppingCenter
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ShoppingCenter'])]
class ShoppingCenter extends LocalBusiness
{
}

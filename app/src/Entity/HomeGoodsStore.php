<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A home goods store.
 *
 * @see https://schema.org/HomeGoodsStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HomeGoodsStore'])]
class HomeGoodsStore extends Store
{
}

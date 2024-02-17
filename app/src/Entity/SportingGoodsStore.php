<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A sporting goods store.
 *
 * @see https://schema.org/SportingGoodsStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SportingGoodsStore'])]
class SportingGoodsStore extends Store
{
}

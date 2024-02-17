<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A bike store.
 *
 * @see https://schema.org/BikeStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BikeStore'])]
class BikeStore extends Store
{
}

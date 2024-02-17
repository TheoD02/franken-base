<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A garden store.
 *
 * @see https://schema.org/GardenStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GardenStore'])]
class GardenStore extends Store
{
}

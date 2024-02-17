<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An electronics store.
 *
 * @see https://schema.org/ElectronicsStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ElectronicsStore'])]
class ElectronicsStore extends Store
{
}

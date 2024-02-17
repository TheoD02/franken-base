<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An outlet store.
 *
 * @see https://schema.org/OutletStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OutletStore'])]
class OutletStore extends Store
{
}

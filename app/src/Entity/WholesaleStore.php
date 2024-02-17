<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A wholesale store.
 *
 * @see https://schema.org/WholesaleStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WholesaleStore'])]
class WholesaleStore extends Store
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A hardware store.
 *
 * @see https://schema.org/HardwareStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HardwareStore'])]
class HardwareStore extends Store
{
}

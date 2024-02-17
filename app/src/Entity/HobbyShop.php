<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A store that sells materials useful or necessary for various hobbies.
 *
 * @see https://schema.org/HobbyShop
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HobbyShop'])]
class HobbyShop extends Store
{
}

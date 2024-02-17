<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A shop that will buy, or lend money against the security of, personal possessions.
 *
 * @see https://schema.org/PawnShop
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PawnShop'])]
class PawnShop extends Store
{
}

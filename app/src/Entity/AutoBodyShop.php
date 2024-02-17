<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Auto body shop.
 *
 * @see https://schema.org/AutoBodyShop
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AutoBodyShop'])]
class AutoBodyShop extends AutomotiveBusiness
{
}

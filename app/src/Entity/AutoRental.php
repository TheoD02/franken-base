<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A car rental business.
 *
 * @see https://schema.org/AutoRental
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AutoRental'])]
class AutoRental extends AutomotiveBusiness
{
}

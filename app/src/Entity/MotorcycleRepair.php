<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A motorcycle repair shop.
 *
 * @see https://schema.org/MotorcycleRepair
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MotorcycleRepair'])]
class MotorcycleRepair extends AutomotiveBusiness
{
}

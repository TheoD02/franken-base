<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A motorcycle dealer.
 *
 * @see https://schema.org/MotorcycleDealer
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MotorcycleDealer'])]
class MotorcycleDealer extends AutomotiveBusiness
{
}

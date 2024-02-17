<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A motorcycle or motorbike is a single-track, two-wheeled motor vehicle.
 *
 * @see https://schema.org/Motorcycle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Motorcycle'])]
class Motorcycle extends Vehicle
{
}

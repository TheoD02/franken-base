<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Animal shelter.
 *
 * @see https://schema.org/AnimalShelter
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AnimalShelter'])]
class AnimalShelter extends LocalBusiness
{
}

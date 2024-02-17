<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A hair salon.
 *
 * @see https://schema.org/HairSalon
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HairSalon'])]
class HairSalon extends HealthAndBeautyBusiness
{
}

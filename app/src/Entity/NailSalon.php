<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A nail salon.
 *
 * @see https://schema.org/NailSalon
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/NailSalon'])]
class NailSalon extends HealthAndBeautyBusiness
{
}

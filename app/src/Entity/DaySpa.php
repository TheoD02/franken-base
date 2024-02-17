<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A day spa.
 *
 * @see https://schema.org/DaySpa
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DaySpa'])]
class DaySpa extends HealthAndBeautyBusiness
{
}

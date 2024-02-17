<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Beauty salon.
 *
 * @see https://schema.org/BeautySalon
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BeautySalon'])]
class BeautySalon extends HealthAndBeautyBusiness
{
}

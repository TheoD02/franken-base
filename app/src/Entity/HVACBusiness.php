<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A business that provides Heating, Ventilation and Air Conditioning services.
 *
 * @see https://schema.org/HVACBusiness
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HVACBusiness'])]
class HVACBusiness extends HomeAndConstructionBusiness
{
}

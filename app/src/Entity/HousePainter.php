<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A house painting service.
 *
 * @see https://schema.org/HousePainter
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HousePainter'])]
class HousePainter extends HomeAndConstructionBusiness
{
}

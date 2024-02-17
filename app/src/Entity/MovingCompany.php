<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A moving company.
 *
 * @see https://schema.org/MovingCompany
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MovingCompany'])]
class MovingCompany extends HomeAndConstructionBusiness
{
}

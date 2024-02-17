<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A plumbing service.
 *
 * @see https://schema.org/Plumber
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Plumber'])]
class Plumber extends HomeAndConstructionBusiness
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A locksmith.
 *
 * @see https://schema.org/Locksmith
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Locksmith'])]
class Locksmith extends HomeAndConstructionBusiness
{
}

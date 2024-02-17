<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An electrician.
 *
 * @see https://schema.org/Electrician
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Electrician'])]
class Electrician extends HomeAndConstructionBusiness
{
}

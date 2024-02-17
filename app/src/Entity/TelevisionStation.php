<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A television station.
 *
 * @see https://schema.org/TelevisionStation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TelevisionStation'])]
class TelevisionStation extends LocalBusiness
{
}

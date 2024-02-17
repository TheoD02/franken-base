<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A tennis complex.
 *
 * @see https://schema.org/TennisComplex
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TennisComplex'])]
class TennisComplex extends SportsActivityLocation
{
}

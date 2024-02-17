<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A legislative building—for example, the state capitol.
 *
 * @see https://schema.org/LegislativeBuilding
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LegislativeBuilding'])]
class LegislativeBuilding extends GovernmentBuilding
{
}

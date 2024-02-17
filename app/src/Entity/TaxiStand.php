<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A taxi stand.
 *
 * @see https://schema.org/TaxiStand
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TaxiStand'])]
class TaxiStand extends CivicStructure
{
}

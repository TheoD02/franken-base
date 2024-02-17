<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A roofing contractor.
 *
 * @see https://schema.org/RoofingContractor
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RoofingContractor'])]
class RoofingContractor extends HomeAndConstructionBusiness
{
}

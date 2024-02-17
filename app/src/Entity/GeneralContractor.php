<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A general contractor.
 *
 * @see https://schema.org/GeneralContractor
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GeneralContractor'])]
class GeneralContractor extends HomeAndConstructionBusiness
{
}

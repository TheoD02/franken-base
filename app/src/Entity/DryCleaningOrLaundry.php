<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A dry-cleaning business.
 *
 * @see https://schema.org/DryCleaningOrLaundry
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DryCleaningOrLaundry'])]
class DryCleaningOrLaundry extends LocalBusiness
{
}

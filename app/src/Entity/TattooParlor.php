<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A tattoo parlor.
 *
 * @see https://schema.org/TattooParlor
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TattooParlor'])]
class TattooParlor extends HealthAndBeautyBusiness
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A health club.
 *
 * @see https://schema.org/HealthClub
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HealthClub'])]
class HealthClub extends HealthAndBeautyBusiness
{
}

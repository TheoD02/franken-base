<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A recycling center.
 *
 * @see https://schema.org/RecyclingCenter
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RecyclingCenter'])]
class RecyclingCenter extends LocalBusiness
{
}

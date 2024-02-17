<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A travel agency.
 *
 * @see https://schema.org/TravelAgency
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TravelAgency'])]
class TravelAgency extends LocalBusiness
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A real-estate agent.
 *
 * @see https://schema.org/RealEstateAgent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RealEstateAgent'])]
class RealEstateAgent extends LocalBusiness
{
}

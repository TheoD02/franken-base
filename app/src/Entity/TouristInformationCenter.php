<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A tourist information center.
 *
 * @see https://schema.org/TouristInformationCenter
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TouristInformationCenter'])]
class TouristInformationCenter extends LocalBusiness
{
}

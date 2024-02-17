<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A fire station. With firemen.
 *
 * @see https://schema.org/FireStation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FireStation'])]
class FireStation extends EmergencyService
{
}

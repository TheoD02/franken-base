<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A radio station.
 *
 * @see https://schema.org/RadioStation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RadioStation'])]
class RadioStation extends LocalBusiness
{
}

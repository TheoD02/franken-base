<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A casino.
 *
 * @see https://schema.org/Casino
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Casino'])]
class Casino extends EntertainmentBusiness
{
}

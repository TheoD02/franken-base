<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A nightclub or discotheque.
 *
 * @see https://schema.org/NightClub
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/NightClub'])]
class NightClub extends EntertainmentBusiness
{
}

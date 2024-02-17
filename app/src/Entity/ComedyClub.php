<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A comedy club.
 *
 * @see https://schema.org/ComedyClub
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ComedyClub'])]
class ComedyClub extends EntertainmentBusiness
{
}

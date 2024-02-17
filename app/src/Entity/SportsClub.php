<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A sports club.
 *
 * @see https://schema.org/SportsClub
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SportsClub'])]
class SportsClub extends SportsActivityLocation
{
}

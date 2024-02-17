<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Season dedicated to radio broadcast and associated online delivery.
 *
 * @see https://schema.org/RadioSeason
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RadioSeason'])]
class RadioSeason extends CreativeWorkSeason
{
}

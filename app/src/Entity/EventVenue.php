<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An event venue.
 *
 * @see https://schema.org/EventVenue
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EventVenue'])]
class EventVenue extends CivicStructure
{
}

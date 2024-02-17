<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event type: Exhibition event, e.g. at a museum, library, archive, tradeshow, ...
 *
 * @see https://schema.org/ExhibitionEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ExhibitionEvent'])]
class ExhibitionEvent extends Event
{
}

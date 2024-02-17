<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A publication event, e.g. catch-up TV or radio podcast, during which a program is available on-demand.
 *
 * @see https://schema.org/OnDemandEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OnDemandEvent'])]
class OnDemandEvent extends PublicationEvent
{
}

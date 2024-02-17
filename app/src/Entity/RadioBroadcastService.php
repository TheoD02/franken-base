<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A delivery service through which radio content is provided via broadcast over the air or online.
 *
 * @see https://schema.org/RadioBroadcastService
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RadioBroadcastService'])]
class RadioBroadcastService extends BroadcastService
{
}

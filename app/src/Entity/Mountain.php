<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A mountain, like Mount Whitney or Mount Everest.
 *
 * @see https://schema.org/Mountain
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Mountain'])]
class Mountain extends Landform
{
}

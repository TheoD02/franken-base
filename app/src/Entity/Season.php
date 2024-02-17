<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A media season, e.g. TV, radio, video game etc.
 *
 * @see https://schema.org/Season
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Season'])]
class Season extends CreativeWork
{
}

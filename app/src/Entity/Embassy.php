<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An embassy.
 *
 * @see https://schema.org/Embassy
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Embassy'])]
class Embassy extends GovernmentBuilding
{
}

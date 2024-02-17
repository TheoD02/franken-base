<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A graveyard.
 *
 * @see https://schema.org/Cemetery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Cemetery'])]
class Cemetery extends CivicStructure
{
}

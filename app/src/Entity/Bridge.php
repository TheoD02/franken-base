<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A bridge.
 *
 * @see https://schema.org/Bridge
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Bridge'])]
class Bridge extends CivicStructure
{
}

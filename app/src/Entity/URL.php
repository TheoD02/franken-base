<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Data type: URL.
 *
 * @see https://schema.org/URL
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/URL'])]
class URL extends Text
{
}

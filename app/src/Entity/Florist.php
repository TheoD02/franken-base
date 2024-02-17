<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A florist.
 *
 * @see https://schema.org/Florist
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Florist'])]
class Florist extends Store
{
}

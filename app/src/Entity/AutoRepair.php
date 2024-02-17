<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Car repair business.
 *
 * @see https://schema.org/AutoRepair
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AutoRepair'])]
class AutoRepair extends AutomotiveBusiness
{
}

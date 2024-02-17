<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A car wash business.
 *
 * @see https://schema.org/AutoWash
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AutoWash'])]
class AutoWash extends AutomotiveBusiness
{
}

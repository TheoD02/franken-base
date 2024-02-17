<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car repair, sales, or parts.
 *
 * @see https://schema.org/AutomotiveBusiness
 */
#[ORM\MappedSuperclass]
abstract class AutomotiveBusiness extends LocalBusiness
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A particular online business, either standalone or the online part of a broader organization. Examples include an eCommerce site, an online travel booking site, an online learning site, an online logistics and shipping provider, an online (virtual) doctor, etc.
 *
 * @see https://schema.org/OnlineBusiness
 */
#[ORM\MappedSuperclass]
abstract class OnlineBusiness extends Organization
{
}

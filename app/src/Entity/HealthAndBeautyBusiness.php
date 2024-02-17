<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Health and beauty.
 *
 * @see https://schema.org/HealthAndBeautyBusiness
 */
#[ORM\MappedSuperclass]
abstract class HealthAndBeautyBusiness extends LocalBusiness
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A body of water, such as a sea, ocean, or lake.
 *
 * @see https://schema.org/BodyOfWater
 */
#[ORM\MappedSuperclass]
abstract class BodyOfWater extends Landform
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A government building.
 *
 * @see https://schema.org/GovernmentBuilding
 */
#[ORM\MappedSuperclass]
abstract class GovernmentBuilding extends CivicStructure
{
}

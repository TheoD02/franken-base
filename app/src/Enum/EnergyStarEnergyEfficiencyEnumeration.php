<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Used to indicate whether a product is EnergyStar certified.
 *
 * @see https://schema.org/EnergyStarEnergyEfficiencyEnumeration
 */
class EnergyStarEnergyEfficiencyEnumeration extends Enum
{
    /** @var string Represents EnergyStar certification. */
    public const ENERGY_STAR_CERTIFIED = 'https://schema.org/EnergyStarCertified';
}

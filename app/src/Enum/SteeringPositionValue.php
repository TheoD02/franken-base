<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * A value indicating a steering position.
 *
 * @see https://schema.org/SteeringPositionValue
 */
class SteeringPositionValue extends Enum
{
    /** @var string The steering position is on the left side of the vehicle (viewed from the main direction of driving). */
    public const LEFT_HAND_DRIVING = 'https://schema.org/LeftHandDriving';

    /** @var string The steering position is on the right side of the vehicle (viewed from the main direction of driving). */
    public const RIGHT_HAND_DRIVING = 'https://schema.org/RightHandDriving';
}

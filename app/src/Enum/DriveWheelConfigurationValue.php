<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * A value indicating which roadwheels will receive torque.
 *
 * @see https://schema.org/DriveWheelConfigurationValue
 */
class DriveWheelConfigurationValue extends Enum
{
    /** @var string Four-wheel drive is a transmission layout where the engine primarily drives two wheels with a part-time four-wheel drive capability. */
    public const FOUR_WHEEL_DRIVE_CONFIGURATION = 'https://schema.org/FourWheelDriveConfiguration';

    /** @var string All-wheel Drive is a transmission layout where the engine drives all four wheels. */
    public const ALL_WHEEL_DRIVE_CONFIGURATION = 'https://schema.org/AllWheelDriveConfiguration';

    /** @var string Front-wheel drive is a transmission layout where the engine drives the front wheels. */
    public const FRONT_WHEEL_DRIVE_CONFIGURATION = 'https://schema.org/FrontWheelDriveConfiguration';

    /** @var string Real-wheel drive is a transmission layout where the engine drives the rear wheels. */
    public const REAR_WHEEL_DRIVE_CONFIGURATION = 'https://schema.org/RearWheelDriveConfiguration';
}

<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * A value indicating a special usage of a car, e.g. commercial rental, driving school, or as a taxi.
 *
 * @see https://schema.org/CarUsageType
 */
class CarUsageType extends Enum
{
    /** @var string Indicates the usage of the car as a taxi. */
    public const TAXI_VEHICLE_USAGE = 'https://schema.org/TaxiVehicleUsage';

    /** @var string Indicates the usage of the vehicle for driving school. */
    public const DRIVING_SCHOOL_VEHICLE_USAGE = 'https://schema.org/DrivingSchoolVehicleUsage';

    /** @var string Indicates the usage of the vehicle as a rental car. */
    public const RENTAL_VEHICLE_USAGE = 'https://schema.org/RentalVehicleUsage';
}

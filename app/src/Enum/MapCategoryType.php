<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * An enumeration of several kinds of Map.
 *
 * @see https://schema.org/MapCategoryType
 */
class MapCategoryType extends Enum
{
    /** @var string A parking map. */
    public const PARKING_MAP = 'https://schema.org/ParkingMap';

    /** @var string A seating map. */
    public const SEATING_MAP = 'https://schema.org/SeatingMap';

    /** @var string A transit map. */
    public const TRANSIT_MAP = 'https://schema.org/TransitMap';

    /** @var string A venue map (e.g. for malls, auditoriums, museums, etc.). */
    public const VENUE_MAP = 'https://schema.org/VenueMap';
}

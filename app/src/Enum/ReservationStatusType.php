<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerated status values for Reservation.
 *
 * @see https://schema.org/ReservationStatusType
 */
class ReservationStatusType extends Enum
{
    /** @var string The status of a reservation when a request has been sent, but not confirmed. */
    public const RESERVATION_PENDING = 'https://schema.org/ReservationPending';

    /** @var string The status of a confirmed reservation. */
    public const RESERVATION_CONFIRMED = 'https://schema.org/ReservationConfirmed';

    /** @var string The status for a previously confirmed reservation that is now cancelled. */
    public const RESERVATION_CANCELLED = 'https://schema.org/ReservationCancelled';

    /** @var string The status of a reservation on hold pending an update like credit card number or flight changes. */
    public const RESERVATION_HOLD = 'https://schema.org/ReservationHold';
}

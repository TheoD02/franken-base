<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * An EventAttendanceModeEnumeration value is one of potentially several modes of organising an event, relating to whether it is online or offline.
 *
 * @see https://schema.org/EventAttendanceModeEnumeration
 */
class EventAttendanceModeEnumeration extends Enum
{
    /** @var string OnlineEventAttendanceMode - an event that is primarily conducted online. */
    public const ONLINE_EVENT_ATTENDANCE_MODE = 'https://schema.org/OnlineEventAttendanceMode';

    /** @var string OfflineEventAttendanceMode - an event that is primarily conducted offline. */
    public const OFFLINE_EVENT_ATTENDANCE_MODE = 'https://schema.org/OfflineEventAttendanceMode';

    /** @var string MixedEventAttendanceMode - an event that is conducted as a combination of both offline and online modes. */
    public const MIXED_EVENT_ATTENDANCE_MODE = 'https://schema.org/MixedEventAttendanceMode';
}

<?php

namespace App\Enum;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MyCLabs\Enum\Enum;

/**
 * EventStatusType is an enumeration type whose instances represent several states that an Event may be in.
 *
 * @see https://schema.org/EventStatusType
 */
class EventStatusType extends Enum
{
	/** @var string The event has been rescheduled. The event's previousStartDate should be set to the old date and the startDate should be set to the event's new date. (If the event has been rescheduled multiple times, the previousStartDate property may be repeated.) */
	public const EVENT_RESCHEDULED = 'https://schema.org/EventRescheduled';

	/** @var string The event has been cancelled. If the event has multiple startDate values, all are assumed to be cancelled. Either startDate or previousStartDate may be used to specify the event's cancelled date(s). */
	public const EVENT_CANCELLED = 'https://schema.org/EventCancelled';

	/** @var string The event is taking place or has taken place on the startDate as scheduled. Use of this value is optional, as it is assumed by default. */
	public const EVENT_SCHEDULED = 'https://schema.org/EventScheduled';

	/** @var string Indicates that the event was changed to allow online participation. See \[\[eventAttendanceMode\]\] for specifics of whether it is now fully or partially online. */
	public const EVENT_MOVED_ONLINE = 'https://schema.org/EventMovedOnline';

	/** @var string The event has been postponed and no new date has been set. The event's previousStartDate should be set. */
	public const EVENT_POSTPONED = 'https://schema.org/EventPostponed';
}

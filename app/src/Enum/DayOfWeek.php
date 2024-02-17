<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * The day of the week, e.g. used to specify to which day the opening hours of an OpeningHoursSpecification refer. Originally, URLs from \[GoodRelations\](http://purl.org/goodrelations/v1) were used (for \[\[Monday\]\], \[\[Tuesday\]\], \[\[Wednesday\]\], \[\[Thursday\]\], \[\[Friday\]\], \[\[Saturday\]\], \[\[Sunday\]\] plus a special entry for \[\[PublicHolidays\]\]); these have now been integrated directly into schema.org.
 *
 * @see https://schema.org/DayOfWeek
 */
class DayOfWeek extends Enum
{
    /** @var string The day of the week between Wednesday and Friday. */
    public const THURSDAY = 'https://schema.org/Thursday';

    /** @var string The day of the week between Thursday and Saturday. */
    public const FRIDAY = 'https://schema.org/Friday';

    /** @var string This stands for any day that is a public holiday; it is a placeholder for all official public holidays in some particular location. While not technically a "day of the week", it can be used with \[\[OpeningHoursSpecification\]\]. In the context of an opening hours specification it can be used to indicate opening hours on public holidays, overriding general opening hours for the day of the week on which a public holiday occurs. */
    public const PUBLIC_HOLIDAYS = 'https://schema.org/PublicHolidays';

    /** @var string The day of the week between Saturday and Monday. */
    public const SUNDAY = 'https://schema.org/Sunday';

    /** @var string The day of the week between Friday and Sunday. */
    public const SATURDAY = 'https://schema.org/Saturday';

    /** @var string The day of the week between Sunday and Tuesday. */
    public const MONDAY = 'https://schema.org/Monday';

    /** @var string The day of the week between Tuesday and Thursday. */
    public const WEDNESDAY = 'https://schema.org/Wednesday';

    /** @var string The day of the week between Monday and Wednesday. */
    public const TUESDAY = 'https://schema.org/Tuesday';
}

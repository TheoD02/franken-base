<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerated options related to a ContactPoint.
 *
 * @see https://schema.org/ContactPointOption
 */
class ContactPointOption extends Enum
{
    /** @var string The associated telephone number is toll free. */
    public const TOLL_FREE = 'https://schema.org/TollFree';

    /** @var string Uses devices to support users with hearing impairments. */
    public const HEARING_IMPAIRED_SUPPORTED = 'https://schema.org/HearingImpairedSupported';
}

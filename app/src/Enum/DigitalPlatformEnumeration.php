<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates some common technology platforms, for use with properties such as \[\[actionPlatform\]\]. It is not supposed to be comprehensive - when a suitable code is not enumerated here, textual or URL values can be used instead. These codes are at a fairly high level and do not deal with versioning and other nuance. Additional codes can be suggested \[in github\](https://github.com/schemaorg/schemaorg/issues/3057).
 *
 * @see https://schema.org/DigitalPlatformEnumeration
 */
class DigitalPlatformEnumeration extends Enum
{
    /** @var string Represents the generic notion of the Web Platform. More specific codes include \[\[MobileWebPlatform\]\] and \[\[DesktopWebPlatform\]\], as an incomplete list. */
    public const GENERIC_WEB_PLATFORM = 'https://schema.org/GenericWebPlatform';

    /** @var string Represents the broad notion of Android-based operating systems. */
    public const ANDROID_PLATFORM = 'https://schema.org/AndroidPlatform';

    /** @var string Represents the broad notion of iOS-based operating systems. */
    public const I_O_S_PLATFORM = 'https://schema.org/IOSPlatform';

    /** @var string Represents the broad notion of 'desktop' browsers as a Web Platform. */
    public const DESKTOP_WEB_PLATFORM = 'https://schema.org/DesktopWebPlatform';

    /** @var string Represents the broad notion of 'mobile' browsers as a Web Platform. */
    public const MOBILE_WEB_PLATFORM = 'https://schema.org/MobileWebPlatform';
}

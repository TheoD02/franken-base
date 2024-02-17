<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Format of this release (the type of recording media used, i.e. compact disc, digital media, LP, etc.).
 *
 * @see https://schema.org/MusicReleaseFormatType
 */
class MusicReleaseFormatType extends Enum
{
    /** @var string DigitalAudioTapeFormat. */
    public const DIGITAL_AUDIO_TAPE_FORMAT = 'https://schema.org/DigitalAudioTapeFormat';

    /** @var string CDFormat. */
    public const C_D_FORMAT = 'https://schema.org/CDFormat';

    /** @var string DigitalFormat. */
    public const DIGITAL_FORMAT = 'https://schema.org/DigitalFormat';

    /** @var string DVDFormat. */
    public const D_V_D_FORMAT = 'https://schema.org/DVDFormat';

    /** @var string VinylFormat. */
    public const VINYL_FORMAT = 'https://schema.org/VinylFormat';

    /** @var string LaserDiscFormat. */
    public const LASER_DISC_FORMAT = 'https://schema.org/LaserDiscFormat';

    /** @var string CassetteFormat. */
    public const CASSETTE_FORMAT = 'https://schema.org/CassetteFormat';
}

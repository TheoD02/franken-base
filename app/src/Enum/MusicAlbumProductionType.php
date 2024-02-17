<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Classification of the album by its type of content: soundtrack, live album, studio album, etc.
 *
 * @see https://schema.org/MusicAlbumProductionType
 */
class MusicAlbumProductionType extends Enum
{
    /** @var string LiveAlbum. */
    public const LIVE_ALBUM = 'https://schema.org/LiveAlbum';

    /** @var string CompilationAlbum. */
    public const COMPILATION_ALBUM = 'https://schema.org/CompilationAlbum';

    /** @var string DemoAlbum. */
    public const DEMO_ALBUM = 'https://schema.org/DemoAlbum';

    /** @var string DJMixAlbum. */
    public const D_J_MIX_ALBUM = 'https://schema.org/DJMixAlbum';

    /** @var string MixtapeAlbum. */
    public const MIXTAPE_ALBUM = 'https://schema.org/MixtapeAlbum';

    /** @var string SoundtrackAlbum. */
    public const SOUNDTRACK_ALBUM = 'https://schema.org/SoundtrackAlbum';

    /** @var string SpokenWordAlbum. */
    public const SPOKEN_WORD_ALBUM = 'https://schema.org/SpokenWordAlbum';

    /** @var string StudioAlbum. */
    public const STUDIO_ALBUM = 'https://schema.org/StudioAlbum';

    /** @var string RemixAlbum. */
    public const REMIX_ALBUM = 'https://schema.org/RemixAlbum';
}

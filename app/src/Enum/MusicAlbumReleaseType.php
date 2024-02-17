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
 * The kind of release which this album is: single, EP or album.
 *
 * @see https://schema.org/MusicAlbumReleaseType
 */
class MusicAlbumReleaseType extends Enum
{
	/** @var string SingleRelease. */
	public const SINGLE_RELEASE = 'https://schema.org/SingleRelease';

	/** @var string BroadcastRelease. */
	public const BROADCAST_RELEASE = 'https://schema.org/BroadcastRelease';

	/** @var string AlbumRelease. */
	public const ALBUM_RELEASE = 'https://schema.org/AlbumRelease';

	/** @var string EPRelease. */
	public const E_P_RELEASE = 'https://schema.org/EPRelease';
}

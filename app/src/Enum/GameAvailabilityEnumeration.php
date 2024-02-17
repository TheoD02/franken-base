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
 * For a \[\[VideoGame\]\], such as used with a \[\[PlayGameAction\]\], an enumeration of the kind of game availability offered.
 *
 * @see https://schema.org/GameAvailabilityEnumeration
 */
class GameAvailabilityEnumeration extends Enum
{
	/** @var string Indicates full game availability. */
	public const FULL_GAME_AVAILABILITY = 'https://schema.org/FullGameAvailability';

	/** @var string Indicates demo game availability, i.e. a somehow limited demonstration of the full game. */
	public const DEMO_GAME_AVAILABILITY = 'https://schema.org/DemoGameAvailability';
}

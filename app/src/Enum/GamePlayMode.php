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
 * Indicates whether this game is multi-player, co-op or single-player.
 *
 * @see https://schema.org/GamePlayMode
 */
class GamePlayMode extends Enum
{
	/** @var string Play mode: CoOp. Co-operative games, where you play on the same team with friends. */
	public const CO_OP = 'https://schema.org/CoOp';

	/** @var string Play mode: SinglePlayer. Which is played by a lone player. */
	public const SINGLE_PLAYER = 'https://schema.org/SinglePlayer';

	/** @var string Play mode: MultiPlayer. Requiring or allowing multiple human players to play simultaneously. */
	public const MULTI_PLAYER = 'https://schema.org/MultiPlayer';
}

<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Enum\GameServerStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Server that provides game interaction in a multiplayer game.
 *
 * @see https://schema.org/GameServer
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GameServer'])]
class GameServer extends Intangible
{
	/**
	 * Number of players on the server.
	 *
	 * @see https://schema.org/playersOnline
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/playersOnline'])]
	private ?int $playersOnline = null;

	/**
	 * Status of a game server.
	 *
	 * @see https://schema.org/serverStatus
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/serverStatus'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [GameServerStatus::class, 'toArray'])]
	private string $serverStatus;

	/**
	 * Video game which is played on this server.
	 *
	 * @see https://schema.org/game
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\VideoGame')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/game'])]
	#[Assert\NotNull]
	private VideoGame $game;

	public function setPlayersOnline(?int $playersOnline): void
	{
		$this->playersOnline = $playersOnline;
	}

	public function getPlayersOnline(): ?int
	{
		return $this->playersOnline;
	}

	public function setServerStatus(string $serverStatus): void
	{
		$this->serverStatus = $serverStatus;
	}

	public function getServerStatus(): string
	{
		return $this->serverStatus;
	}

	public function setGame(VideoGame $game): void
	{
		$this->game = $game;
	}

	public function getGame(): VideoGame
	{
		return $this->game;
	}
}

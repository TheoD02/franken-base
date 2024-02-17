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
use App\Enum\GamePlayMode;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A video game series.
 *
 * @see https://schema.org/VideoGameSeries
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VideoGameSeries'])]
class VideoGameSeries extends CreativeWorkSeries
{
	/**
	 * An actor, e.g. in TV, radio, movie, video games etc., or in an event. Actors can be associated with individual items or with a series, episode, clip.
	 *
	 * @see https://schema.org/actor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/actor'])]
	#[Assert\NotNull]
	private Person $actor;

	/**
	 * The number of episodes in this season or series.
	 *
	 * @see https://schema.org/numberOfEpisodes
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/numberOfEpisodes'])]
	private ?int $numberOfEpisodes = null;

	/**
	 * The number of seasons in this series.
	 *
	 * @see https://schema.org/numberOfSeasons
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/numberOfSeasons'])]
	private ?int $numberOfSeasons = null;

	/**
	 * The electronic systems used to play [video games](http://en.wikipedia.org/wiki/Category:Video_game_platforms).
	 *
	 * @see https://schema.org/gamePlatform
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ApiProperty(types: ['https://schema.org/gamePlatform'])]
	private ?Thing $gamePlatform = null;

	/**
	 * A director of e.g. TV, radio, movie, video gaming etc. content, or of an event. Directors can be associated with individual items or with a series, episode, clip.
	 *
	 * @see https://schema.org/director
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/director'])]
	#[Assert\NotNull]
	private Person $director;

	/**
	 * Real or fictional location of the game (or part of game).
	 *
	 * @see https://schema.org/gameLocation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PostalAddress')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/gameLocation'])]
	#[Assert\NotNull]
	private PostalAddress $gameLocation;

	/**
	 * The production company or studio responsible for the item, e.g. series, video game, episode etc.
	 *
	 * @see https://schema.org/productionCompany
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/productionCompany'])]
	private ?Organization $productionCompany = null;

	/**
	 * The trailer of a movie or TV/radio series, season, episode, etc.
	 *
	 * @see https://schema.org/trailer
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\VideoObject')]
	#[ApiProperty(types: ['https://schema.org/trailer'])]
	private ?VideoObject $trailer = null;

	/**
	 * An episode of a TV, radio or game media within a series or season.
	 *
	 * @see https://schema.org/episode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Episode')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/episode'])]
	#[Assert\NotNull]
	private Episode $episode;

	/**
	 * The composer of the soundtrack.
	 *
	 * @see https://schema.org/musicBy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ApiProperty(types: ['https://schema.org/musicBy'])]
	private ?Person $musicBy = null;

	/**
	 * An item is an object within the game world that can be collected by a player or, occasionally, a non-player character.
	 *
	 * @see https://schema.org/gameItem
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/gameItem'])]
	#[Assert\NotNull]
	private Thing $gameItem;

	/**
	 * Indicates whether this game is multi-player, co-op or single-player. The game can be marked as multi-player, co-op and single-player at the same time.
	 *
	 * @see https://schema.org/playMode
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/playMode'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [GamePlayMode::class, 'toArray'])]
	private string $playMode;

	/**
	 * A piece of data that represents a particular aspect of a fictional character (skill, power, character points, advantage, disadvantage).
	 *
	 * @see https://schema.org/characterAttribute
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/characterAttribute'])]
	#[Assert\NotNull]
	private Thing $characterAttribute;

	/**
	 * The task that a player-controlled character, or group of characters may complete in order to gain a reward.
	 *
	 * @see https://schema.org/quest
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
	#[ApiProperty(types: ['https://schema.org/quest'])]
	private ?Thing $quest = null;

	/**
	 * Indicate how many people can play this game (minimum, maximum, or range).
	 *
	 * @see https://schema.org/numberOfPlayers
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/numberOfPlayers'])]
	#[Assert\NotNull]
	private QuantitativeValue $numberOfPlayers;

	/**
	 * Cheat codes to the game.
	 *
	 * @see https://schema.org/cheatCode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/cheatCode'])]
	#[Assert\NotNull]
	private CreativeWork $cheatCode;

	/**
	 * A season that is part of the media series.
	 *
	 * @see https://schema.org/containsSeason
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWorkSeason')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/containsSeason'])]
	#[Assert\NotNull]
	private CreativeWorkSeason $containsSeason;

	public function setActor(Person $actor): void
	{
		$this->actor = $actor;
	}

	public function getActor(): Person
	{
		return $this->actor;
	}

	public function setNumberOfEpisodes(?int $numberOfEpisodes): void
	{
		$this->numberOfEpisodes = $numberOfEpisodes;
	}

	public function getNumberOfEpisodes(): ?int
	{
		return $this->numberOfEpisodes;
	}

	public function setNumberOfSeasons(?int $numberOfSeasons): void
	{
		$this->numberOfSeasons = $numberOfSeasons;
	}

	public function getNumberOfSeasons(): ?int
	{
		return $this->numberOfSeasons;
	}

	public function setGamePlatform(?Thing $gamePlatform): void
	{
		$this->gamePlatform = $gamePlatform;
	}

	public function getGamePlatform(): ?Thing
	{
		return $this->gamePlatform;
	}

	public function setDirector(Person $director): void
	{
		$this->director = $director;
	}

	public function getDirector(): Person
	{
		return $this->director;
	}

	public function setGameLocation(PostalAddress $gameLocation): void
	{
		$this->gameLocation = $gameLocation;
	}

	public function getGameLocation(): PostalAddress
	{
		return $this->gameLocation;
	}

	public function setProductionCompany(?Organization $productionCompany): void
	{
		$this->productionCompany = $productionCompany;
	}

	public function getProductionCompany(): ?Organization
	{
		return $this->productionCompany;
	}

	public function setTrailer(?VideoObject $trailer): void
	{
		$this->trailer = $trailer;
	}

	public function getTrailer(): ?VideoObject
	{
		return $this->trailer;
	}

	public function setEpisode(Episode $episode): void
	{
		$this->episode = $episode;
	}

	public function getEpisode(): Episode
	{
		return $this->episode;
	}

	public function setMusicBy(?Person $musicBy): void
	{
		$this->musicBy = $musicBy;
	}

	public function getMusicBy(): ?Person
	{
		return $this->musicBy;
	}

	public function setGameItem(Thing $gameItem): void
	{
		$this->gameItem = $gameItem;
	}

	public function getGameItem(): Thing
	{
		return $this->gameItem;
	}

	public function setPlayMode(string $playMode): void
	{
		$this->playMode = $playMode;
	}

	public function getPlayMode(): string
	{
		return $this->playMode;
	}

	public function setCharacterAttribute(Thing $characterAttribute): void
	{
		$this->characterAttribute = $characterAttribute;
	}

	public function getCharacterAttribute(): Thing
	{
		return $this->characterAttribute;
	}

	public function setQuest(?Thing $quest): void
	{
		$this->quest = $quest;
	}

	public function getQuest(): ?Thing
	{
		return $this->quest;
	}

	public function setNumberOfPlayers(QuantitativeValue $numberOfPlayers): void
	{
		$this->numberOfPlayers = $numberOfPlayers;
	}

	public function getNumberOfPlayers(): QuantitativeValue
	{
		return $this->numberOfPlayers;
	}

	public function setCheatCode(CreativeWork $cheatCode): void
	{
		$this->cheatCode = $cheatCode;
	}

	public function getCheatCode(): CreativeWork
	{
		return $this->cheatCode;
	}

	public function setContainsSeason(CreativeWorkSeason $containsSeason): void
	{
		$this->containsSeason = $containsSeason;
	}

	public function getContainsSeason(): CreativeWorkSeason
	{
		return $this->containsSeason;
	}
}

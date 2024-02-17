<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\GamePlayMode;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A video game is an electronic game that involves human interaction with a user interface to generate visual feedback on a video device.
 *
 * @see https://schema.org/VideoGame
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/VideoGame'])]
class VideoGame extends SoftwareApplication
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
     * The electronic systems used to play [video games](http://en.wikipedia.org/wiki/Category:Video_game_platforms).
     *
     * @see https://schema.org/gamePlatform
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ApiProperty(types: ['https://schema.org/gamePlatform'])]
    private ?Thing $gamePlatform = null;

    /**
     * The edition of a video game.
     *
     * @see https://schema.org/gameEdition
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/gameEdition'])]
    private ?string $gameEdition = null;

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
     * Links to tips, tactics, etc.
     *
     * @see https://schema.org/gameTip
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/gameTip'])]
    #[Assert\NotNull]
    private CreativeWork $gameTip;

    /**
     * The trailer of a movie or TV/radio series, season, episode, etc.
     *
     * @see https://schema.org/trailer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\VideoObject')]
    #[ApiProperty(types: ['https://schema.org/trailer'])]
    private ?VideoObject $trailer = null;

    /**
     * The composer of the soundtrack.
     *
     * @see https://schema.org/musicBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/musicBy'])]
    private ?Person $musicBy = null;

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
     * The server on which it is possible to play the game.
     *
     * @see https://schema.org/gameServer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\GameServer')]
    #[ApiProperty(types: ['https://schema.org/gameServer'])]
    private ?GameServer $gameServer = null;

    public function setActor(Person $actor): void
    {
        $this->actor = $actor;
    }

    public function getActor(): Person
    {
        return $this->actor;
    }

    public function setGamePlatform(?Thing $gamePlatform): void
    {
        $this->gamePlatform = $gamePlatform;
    }

    public function getGamePlatform(): ?Thing
    {
        return $this->gamePlatform;
    }

    public function setGameEdition(?string $gameEdition): void
    {
        $this->gameEdition = $gameEdition;
    }

    public function getGameEdition(): ?string
    {
        return $this->gameEdition;
    }

    public function setDirector(Person $director): void
    {
        $this->director = $director;
    }

    public function getDirector(): Person
    {
        return $this->director;
    }

    public function setGameTip(CreativeWork $gameTip): void
    {
        $this->gameTip = $gameTip;
    }

    public function getGameTip(): CreativeWork
    {
        return $this->gameTip;
    }

    public function setTrailer(?VideoObject $trailer): void
    {
        $this->trailer = $trailer;
    }

    public function getTrailer(): ?VideoObject
    {
        return $this->trailer;
    }

    public function setMusicBy(?Person $musicBy): void
    {
        $this->musicBy = $musicBy;
    }

    public function getMusicBy(): ?Person
    {
        return $this->musicBy;
    }

    public function setPlayMode(string $playMode): void
    {
        $this->playMode = $playMode;
    }

    public function getPlayMode(): string
    {
        return $this->playMode;
    }

    public function setCheatCode(CreativeWork $cheatCode): void
    {
        $this->cheatCode = $cheatCode;
    }

    public function getCheatCode(): CreativeWork
    {
        return $this->cheatCode;
    }

    public function setGameServer(?GameServer $gameServer): void
    {
        $this->gameServer = $gameServer;
    }

    public function getGameServer(): ?GameServer
    {
        return $this->gameServer;
    }
}

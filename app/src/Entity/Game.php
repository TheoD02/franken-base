<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The Game type represents things which are games. These are typically rule-governed recreational activities, e.g. role-playing games in which players assume the role of characters in a fictional setting.
 *
 * @see https://schema.org/Game
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Game'])]
class Game extends CreativeWork
{
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

    public function setGameLocation(PostalAddress $gameLocation): void
    {
        $this->gameLocation = $gameLocation;
    }

    public function getGameLocation(): PostalAddress
    {
        return $this->gameLocation;
    }

    public function setGameItem(Thing $gameItem): void
    {
        $this->gameItem = $gameItem;
    }

    public function getGameItem(): Thing
    {
        return $this->gameItem;
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
}

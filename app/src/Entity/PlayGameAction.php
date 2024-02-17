<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\GameAvailabilityEnumeration;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of playing a video game.
 *
 * @see https://schema.org/PlayGameAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PlayGameAction'])]
class PlayGameAction extends ConsumeAction
{
    /**
     * Indicates the availability type of the game content associated with this action, such as whether it is a full version or a demo.
     *
     * @see https://schema.org/gameAvailabilityType
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/gameAvailabilityType'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [GameAvailabilityEnumeration::class, 'toArray'])]
    private string $gameAvailabilityType;

    public function setGameAvailabilityType(string $gameAvailabilityType): void
    {
        $this->gameAvailabilityType = $gameAvailabilityType;
    }

    public function getGameAvailabilityType(): string
    {
        return $this->gameAvailabilityType;
    }
}

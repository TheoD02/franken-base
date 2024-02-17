<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of an agent relocating to a place.\\n\\nRelated actions:\\n\\n\* \[\[TransferAction\]\]: Unlike TransferAction, the subject of the move is a living Person or Organization rather than an inanimate object.
 *
 * @see https://schema.org/MoveAction
 */
#[ORM\MappedSuperclass]
abstract class MoveAction extends Action
{
    /**
     * A sub property of location. The final location of the object or the agent after the action.
     *
     * @see https://schema.org/toLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/toLocation'])]
    #[Assert\NotNull]
    private Place $toLocation;

    /**
     * A sub property of location. The original location of the object or the agent before the action.
     *
     * @see https://schema.org/fromLocation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/fromLocation'])]
    #[Assert\NotNull]
    private Place $fromLocation;

    public function setToLocation(Place $toLocation): void
    {
        $this->toLocation = $toLocation;
    }

    public function getToLocation(): Place
    {
        return $this->toLocation;
    }

    public function setFromLocation(Place $fromLocation): void
    {
        $this->fromLocation = $fromLocation;
    }

    public function getFromLocation(): Place
    {
        return $this->fromLocation;
    }
}

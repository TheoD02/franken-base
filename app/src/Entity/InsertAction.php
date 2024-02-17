<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of adding at a specific location in an ordered collection.
 *
 * @see https://schema.org/InsertAction
 */
#[ORM\MappedSuperclass]
abstract class InsertAction extends AddAction
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

    public function setToLocation(Place $toLocation): void
    {
        $this->toLocation = $toLocation;
    }

    public function getToLocation(): Place
    {
        return $this->toLocation;
    }
}

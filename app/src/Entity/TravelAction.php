<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of traveling from a fromLocation to a destination by a specified mode of transport, optionally with participants.
 *
 * @see https://schema.org/TravelAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TravelAction'])]
class TravelAction extends MoveAction
{
    /**
     * The distance travelled, e.g. exercising or travelling.
     *
     * @see https://schema.org/distance
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Distance')]
    #[ApiProperty(types: ['https://schema.org/distance'])]
    private ?Distance $distance = null;

    public function setDistance(?Distance $distance): void
    {
        $this->distance = $distance;
    }

    public function getDistance(): ?Distance
    {
        return $this->distance;
    }
}

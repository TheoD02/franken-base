<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * This is the \[\[Action\]\] of navigating to a specific \[\[startOffset\]\] timestamp within a \[\[VideoObject\]\], typically represented with a URL template structure.
 *
 * @see https://schema.org/SeekToAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SeekToAction'])]
class SeekToAction extends Action
{
    /**
     * The start time of the clip expressed as the number of seconds from the beginning of the work.
     *
     * @see https://schema.org/startOffset
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/startOffset'])]
    private ?string $startOffset = null;

    public function setStartOffset(?string $startOffset): void
    {
        $this->startOffset = $startOffset;
    }

    public function getStartOffset(): ?string
    {
        return $this->startOffset;
    }
}

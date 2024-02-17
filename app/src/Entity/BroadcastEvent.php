<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An over the air or online broadcast event.
 *
 * @see https://schema.org/BroadcastEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BroadcastEvent'])]
class BroadcastEvent extends PublicationEvent
{
    /**
     * Languages in which subtitles/captions are available, in \[IETF BCP 47 standard format\](http://tools.ietf.org/html/bcp47).
     *
     * @see https://schema.org/subtitleLanguage
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/subtitleLanguage'])]
    private ?string $subtitleLanguage = null;

    /**
     * The event being broadcast such as a sporting event or awards ceremony.
     *
     * @see https://schema.org/broadcastOfEvent
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Event')]
    #[ApiProperty(types: ['https://schema.org/broadcastOfEvent'])]
    private ?Event $broadcastOfEvent = null;

    /**
     * True if the broadcast is of a live event.
     *
     * @see https://schema.org/isLiveBroadcast
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/isLiveBroadcast'])]
    private ?bool $isLiveBroadcast = null;

    /**
     * The type of screening or video broadcast used (e.g. IMAX, 3D, SD, HD, etc.).
     *
     * @see https://schema.org/videoFormat
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/videoFormat'])]
    private ?string $videoFormat = null;

    public function setSubtitleLanguage(?string $subtitleLanguage): void
    {
        $this->subtitleLanguage = $subtitleLanguage;
    }

    public function getSubtitleLanguage(): ?string
    {
        return $this->subtitleLanguage;
    }

    public function setBroadcastOfEvent(?Event $broadcastOfEvent): void
    {
        $this->broadcastOfEvent = $broadcastOfEvent;
    }

    public function getBroadcastOfEvent(): ?Event
    {
        return $this->broadcastOfEvent;
    }

    public function setIsLiveBroadcast(?bool $isLiveBroadcast): void
    {
        $this->isLiveBroadcast = $isLiveBroadcast;
    }

    public function getIsLiveBroadcast(): ?bool
    {
        return $this->isLiveBroadcast;
    }

    public function setVideoFormat(?string $videoFormat): void
    {
        $this->videoFormat = $videoFormat;
    }

    public function getVideoFormat(): ?string
    {
        return $this->videoFormat;
    }
}

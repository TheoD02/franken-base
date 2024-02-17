<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A screening of a movie or other video.
 *
 * @see https://schema.org/ScreeningEvent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ScreeningEvent'])]
class ScreeningEvent extends Event
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
     * The movie presented during this event.
     *
     * @see https://schema.org/workPresented
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Movie')]
    #[ApiProperty(types: ['https://schema.org/workPresented'])]
    private ?Movie $workPresented = null;

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

    public function setWorkPresented(?Movie $workPresented): void
    {
        $this->workPresented = $workPresented;
    }

    public function getWorkPresented(): ?Movie
    {
        return $this->workPresented;
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

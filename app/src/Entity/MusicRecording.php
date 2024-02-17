<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A music recording (track), usually a single song.
 *
 * @see https://schema.org/MusicRecording
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MusicRecording'])]
class MusicRecording extends CreativeWork
{
    /**
     * The album to which this recording belongs.
     *
     * @see https://schema.org/inAlbum
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MusicAlbum')]
    #[ApiProperty(types: ['https://schema.org/inAlbum'])]
    private ?MusicAlbum $inAlbum = null;

    /**
     * The duration of the item (movie, audio recording, event, etc.) in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/duration
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/duration'])]
    private ?Duration $duration = null;

    /**
     * The artist that performed this album or recording.
     *
     * @see https://schema.org/byArtist
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/byArtist'])]
    private ?Person $byArtist = null;

    /**
     * The International Standard Recording Code for the recording.
     *
     * @see https://schema.org/isrcCode
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/isrcCode'])]
    private ?string $isrcCode = null;

    /**
     * The playlist to which this recording belongs.
     *
     * @see https://schema.org/inPlaylist
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MusicPlaylist')]
    #[ApiProperty(types: ['https://schema.org/inPlaylist'])]
    private ?MusicPlaylist $inPlaylist = null;

    /**
     * The composition this track is a recording of.
     *
     * @see https://schema.org/recordingOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MusicComposition')]
    #[ApiProperty(types: ['https://schema.org/recordingOf'])]
    private ?MusicComposition $recordingOf = null;

    public function setInAlbum(?MusicAlbum $inAlbum): void
    {
        $this->inAlbum = $inAlbum;
    }

    public function getInAlbum(): ?MusicAlbum
    {
        return $this->inAlbum;
    }

    public function setDuration(?Duration $duration): void
    {
        $this->duration = $duration;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function setByArtist(?Person $byArtist): void
    {
        $this->byArtist = $byArtist;
    }

    public function getByArtist(): ?Person
    {
        return $this->byArtist;
    }

    public function setIsrcCode(?string $isrcCode): void
    {
        $this->isrcCode = $isrcCode;
    }

    public function getIsrcCode(): ?string
    {
        return $this->isrcCode;
    }

    public function setInPlaylist(?MusicPlaylist $inPlaylist): void
    {
        $this->inPlaylist = $inPlaylist;
    }

    public function getInPlaylist(): ?MusicPlaylist
    {
        return $this->inPlaylist;
    }

    public function setRecordingOf(?MusicComposition $recordingOf): void
    {
        $this->recordingOf = $recordingOf;
    }

    public function getRecordingOf(): ?MusicComposition
    {
        return $this->recordingOf;
    }
}

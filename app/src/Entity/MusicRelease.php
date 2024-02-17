<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\MusicReleaseFormatType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A MusicRelease is a specific release of a music album.
 *
 * @see https://schema.org/MusicRelease
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MusicRelease'])]
class MusicRelease extends MusicPlaylist
{
    /**
     * The group the release is credited to if different than the byArtist. For example, Red and Blue is credited to "Stefani Germanotta Band", but by Lady Gaga.
     *
     * @see https://schema.org/creditedTo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ApiProperty(types: ['https://schema.org/creditedTo'])]
    private ?Organization $creditedTo = null;

    /**
     * The catalog number for the release.
     *
     * @see https://schema.org/catalogNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/catalogNumber'])]
    private ?string $catalogNumber = null;

    /**
     * The duration of the item (movie, audio recording, event, etc.) in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/duration
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/duration'])]
    private ?Duration $duration = null;

    /**
     * Format of this release (the type of recording media used, i.e. compact disc, digital media, LP, etc.).
     *
     * @see https://schema.org/musicReleaseFormat
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/musicReleaseFormat'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [MusicReleaseFormatType::class, 'toArray'])]
    private string $musicReleaseFormat;

    /**
     * The label that issued the release.
     *
     * @see https://schema.org/recordLabel
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ApiProperty(types: ['https://schema.org/recordLabel'])]
    private ?Organization $recordLabel = null;

    /**
     * The album this is a release of.
     *
     * @see https://schema.org/releaseOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MusicAlbum')]
    #[ApiProperty(types: ['https://schema.org/releaseOf'])]
    private ?MusicAlbum $releaseOf = null;

    public function setCreditedTo(?Organization $creditedTo): void
    {
        $this->creditedTo = $creditedTo;
    }

    public function getCreditedTo(): ?Organization
    {
        return $this->creditedTo;
    }

    public function setCatalogNumber(?string $catalogNumber): void
    {
        $this->catalogNumber = $catalogNumber;
    }

    public function getCatalogNumber(): ?string
    {
        return $this->catalogNumber;
    }

    public function setDuration(?Duration $duration): void
    {
        $this->duration = $duration;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function setMusicReleaseFormat(string $musicReleaseFormat): void
    {
        $this->musicReleaseFormat = $musicReleaseFormat;
    }

    public function getMusicReleaseFormat(): string
    {
        return $this->musicReleaseFormat;
    }

    public function setRecordLabel(?Organization $recordLabel): void
    {
        $this->recordLabel = $recordLabel;
    }

    public function getRecordLabel(): ?Organization
    {
        return $this->recordLabel;
    }

    public function setReleaseOf(?MusicAlbum $releaseOf): void
    {
        $this->releaseOf = $releaseOf;
    }

    public function getReleaseOf(): ?MusicAlbum
    {
        return $this->releaseOf;
    }
}

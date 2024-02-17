<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A short TV or radio program or a segment/part of a program.
 *
 * @see https://schema.org/Clip
 */
#[ORM\MappedSuperclass]
abstract class Clip extends CreativeWork
{
    /**
     * An actor, e.g. in TV, radio, movie, video games etc., or in an event. Actors can be associated with individual items or with a series, episode, clip.
     *
     * @see https://schema.org/actor
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/actor'])]
    #[Assert\NotNull]
    private Person $actor;

    /**
     * The start time of the clip expressed as the number of seconds from the beginning of the work.
     *
     * @see https://schema.org/startOffset
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/startOffset'])]
    private ?string $startOffset = null;

    /**
     * Position of the clip within an ordered group of clips.
     *
     * @see https://schema.org/clipNumber
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/clipNumber'])]
    private ?string $clipNumber = null;

    /**
     * The series to which this episode or season belongs.
     *
     * @see https://schema.org/partOfSeries
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWorkSeries')]
    #[ApiProperty(types: ['https://schema.org/partOfSeries'])]
    private ?CreativeWorkSeries $partOfSeries = null;

    /**
     * A director of e.g. TV, radio, movie, video gaming etc. content, or of an event. Directors can be associated with individual items or with a series, episode, clip.
     *
     * @see https://schema.org/director
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/director'])]
    #[Assert\NotNull]
    private Person $director;

    /**
     * The episode to which this clip belongs.
     *
     * @see https://schema.org/partOfEpisode
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Episode')]
    #[ApiProperty(types: ['https://schema.org/partOfEpisode'])]
    private ?Episode $partOfEpisode = null;

    /**
     * The season to which this episode belongs.
     *
     * @see https://schema.org/partOfSeason
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWorkSeason')]
    #[ApiProperty(types: ['https://schema.org/partOfSeason'])]
    private ?CreativeWorkSeason $partOfSeason = null;

    /**
     * The composer of the soundtrack.
     *
     * @see https://schema.org/musicBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/musicBy'])]
    private ?Person $musicBy = null;

    /**
     * The end time of the clip expressed as the number of seconds from the beginning of the work.
     *
     * @see https://schema.org/endOffset
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\HyperTocEntry')]
    #[ApiProperty(types: ['https://schema.org/endOffset'])]
    private ?HyperTocEntry $endOffset = null;

    public function setActor(Person $actor): void
    {
        $this->actor = $actor;
    }

    public function getActor(): Person
    {
        return $this->actor;
    }

    public function setStartOffset(?string $startOffset): void
    {
        $this->startOffset = $startOffset;
    }

    public function getStartOffset(): ?string
    {
        return $this->startOffset;
    }

    public function setClipNumber(?string $clipNumber): void
    {
        $this->clipNumber = $clipNumber;
    }

    public function getClipNumber(): ?string
    {
        return $this->clipNumber;
    }

    public function setPartOfSeries(?CreativeWorkSeries $partOfSeries): void
    {
        $this->partOfSeries = $partOfSeries;
    }

    public function getPartOfSeries(): ?CreativeWorkSeries
    {
        return $this->partOfSeries;
    }

    public function setDirector(Person $director): void
    {
        $this->director = $director;
    }

    public function getDirector(): Person
    {
        return $this->director;
    }

    public function setPartOfEpisode(?Episode $partOfEpisode): void
    {
        $this->partOfEpisode = $partOfEpisode;
    }

    public function getPartOfEpisode(): ?Episode
    {
        return $this->partOfEpisode;
    }

    public function setPartOfSeason(?CreativeWorkSeason $partOfSeason): void
    {
        $this->partOfSeason = $partOfSeason;
    }

    public function getPartOfSeason(): ?CreativeWorkSeason
    {
        return $this->partOfSeason;
    }

    public function setMusicBy(?Person $musicBy): void
    {
        $this->musicBy = $musicBy;
    }

    public function getMusicBy(): ?Person
    {
        return $this->musicBy;
    }

    public function setEndOffset(?HyperTocEntry $endOffset): void
    {
        $this->endOffset = $endOffset;
    }

    public function getEndOffset(): ?HyperTocEntry
    {
        return $this->endOffset;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A media episode (e.g. TV, radio, video game) which can be part of a series or season.
 *
 * @see https://schema.org/Episode
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'episode' => Episode::class,
    'radioEpisode' => RadioEpisode::class,
    'podcastEpisode' => PodcastEpisode::class,
    'TVEpisode' => TVEpisode::class,
])]
class Episode extends CreativeWork
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
     * The production company or studio responsible for the item, e.g. series, video game, episode etc.
     *
     * @see https://schema.org/productionCompany
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ApiProperty(types: ['https://schema.org/productionCompany'])]
    private ?Organization $productionCompany = null;

    /**
     * The trailer of a movie or TV/radio series, season, episode, etc.
     *
     * @see https://schema.org/trailer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\VideoObject')]
    #[ApiProperty(types: ['https://schema.org/trailer'])]
    private ?VideoObject $trailer = null;

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
     * The duration of the item (movie, audio recording, event, etc.) in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601).
     *
     * @see https://schema.org/duration
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/duration'])]
    private ?Duration $duration = null;

    /**
     * Position of the episode within an ordered group of episodes.
     *
     * @see https://schema.org/episodeNumber
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/episodeNumber'])]
    private ?string $episodeNumber = null;

    public function setActor(Person $actor): void
    {
        $this->actor = $actor;
    }

    public function getActor(): Person
    {
        return $this->actor;
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

    public function setProductionCompany(?Organization $productionCompany): void
    {
        $this->productionCompany = $productionCompany;
    }

    public function getProductionCompany(): ?Organization
    {
        return $this->productionCompany;
    }

    public function setTrailer(?VideoObject $trailer): void
    {
        $this->trailer = $trailer;
    }

    public function getTrailer(): ?VideoObject
    {
        return $this->trailer;
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

    public function setDuration(?Duration $duration): void
    {
        $this->duration = $duration;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function setEpisodeNumber(?string $episodeNumber): void
    {
        $this->episodeNumber = $episodeNumber;
    }

    public function getEpisodeNumber(): ?string
    {
        return $this->episodeNumber;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A media season, e.g. TV, radio, video game etc.
 *
 * @see https://schema.org/CreativeWorkSeason
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'creativeWorkSeason' => CreativeWorkSeason::class,
    'podcastSeason' => PodcastSeason::class,
    'radioSeason' => RadioSeason::class,
    'TVSeason' => TVSeason::class,
])]
class CreativeWorkSeason extends CreativeWork
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
     * The number of episodes in this season or series.
     *
     * @see https://schema.org/numberOfEpisodes
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/numberOfEpisodes'])]
    private ?int $numberOfEpisodes = null;

    /**
     * The start date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @see https://schema.org/startDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/startDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $startDate = null;

    /**
     * The end date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @see https://schema.org/endDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/endDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $endDate = null;

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
     * An episode of a TV, radio or game media within a series or season.
     *
     * @see https://schema.org/episode
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Episode')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/episode'])]
    #[Assert\NotNull]
    private Episode $episode;

    /**
     * Position of the season within an ordered group of seasons.
     *
     * @see https://schema.org/seasonNumber
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/seasonNumber'])]
    private ?string $seasonNumber = null;

    public function setActor(Person $actor): void
    {
        $this->actor = $actor;
    }

    public function getActor(): Person
    {
        return $this->actor;
    }

    public function setNumberOfEpisodes(?int $numberOfEpisodes): void
    {
        $this->numberOfEpisodes = $numberOfEpisodes;
    }

    public function getNumberOfEpisodes(): ?int
    {
        return $this->numberOfEpisodes;
    }

    public function setStartDate(?\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
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

    public function setEpisode(Episode $episode): void
    {
        $this->episode = $episode;
    }

    public function getEpisode(): Episode
    {
        return $this->episode;
    }

    public function setSeasonNumber(?string $seasonNumber): void
    {
        $this->seasonNumber = $seasonNumber;
    }

    public function getSeasonNumber(): ?string
    {
        return $this->seasonNumber;
    }
}

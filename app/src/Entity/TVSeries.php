<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CreativeWorkSeries dedicated to TV broadcast and associated online delivery.
 *
 * @see https://schema.org/TVSeries
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TVSeries'])]
class TVSeries extends CreativeWork
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
     * An \[EIDR\](https://eidr.org/) (Entertainment Identifier Registry) \[\[identifier\]\] representing at the most general/abstract level, a work of film or television. For example, the motion picture known as "Ghostbusters" has a titleEIDR of "10.5240/7EC7-228A-510A-053E-CBB8-J". This title (or work) may have several variants, which EIDR calls "edits". See \[\[editEIDR\]\]. Since schema.org types like \[\[Movie\]\], \[\[TVEpisode\]\], \[\[TVSeason\]\], and \[\[TVSeries\]\] can be used for both works and their multiple expressions, it is possible to use \[\[titleEIDR\]\] alone (for a general description), or alongside \[\[editEIDR\]\] for a more edit-specific description.
     *
     * @see https://schema.org/titleEIDR
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/titleEIDR'])]
    private ?string $titleEIDR = null;

    /**
     * The number of episodes in this season or series.
     *
     * @see https://schema.org/numberOfEpisodes
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/numberOfEpisodes'])]
    private ?int $numberOfEpisodes = null;

    /**
     * The number of seasons in this series.
     *
     * @see https://schema.org/numberOfSeasons
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/numberOfSeasons'])]
    private ?int $numberOfSeasons = null;

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
     * The composer of the soundtrack.
     *
     * @see https://schema.org/musicBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/musicBy'])]
    private ?Person $musicBy = null;

    /**
     * A season that is part of the media series.
     *
     * @see https://schema.org/containsSeason
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWorkSeason')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/containsSeason'])]
    #[Assert\NotNull]
    private CreativeWorkSeason $containsSeason;

    public function setActor(Person $actor): void
    {
        $this->actor = $actor;
    }

    public function getActor(): Person
    {
        return $this->actor;
    }

    public function setTitleEIDR(?string $titleEIDR): void
    {
        $this->titleEIDR = $titleEIDR;
    }

    public function getTitleEIDR(): ?string
    {
        return $this->titleEIDR;
    }

    public function setNumberOfEpisodes(?int $numberOfEpisodes): void
    {
        $this->numberOfEpisodes = $numberOfEpisodes;
    }

    public function getNumberOfEpisodes(): ?int
    {
        return $this->numberOfEpisodes;
    }

    public function setNumberOfSeasons(?int $numberOfSeasons): void
    {
        $this->numberOfSeasons = $numberOfSeasons;
    }

    public function getNumberOfSeasons(): ?int
    {
        return $this->numberOfSeasons;
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

    public function setMusicBy(?Person $musicBy): void
    {
        $this->musicBy = $musicBy;
    }

    public function getMusicBy(): ?Person
    {
        return $this->musicBy;
    }

    public function setContainsSeason(CreativeWorkSeason $containsSeason): void
    {
        $this->containsSeason = $containsSeason;
    }

    public function getContainsSeason(): CreativeWorkSeason
    {
        return $this->containsSeason;
    }
}

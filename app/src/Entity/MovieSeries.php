<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A series of movies. Included movies can be indicated with the hasPart property.
 *
 * @see https://schema.org/MovieSeries
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MovieSeries'])]
class MovieSeries extends CreativeWorkSeries
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
     * The composer of the soundtrack.
     *
     * @see https://schema.org/musicBy
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/musicBy'])]
    private ?Person $musicBy = null;

    public function setActor(Person $actor): void
    {
        $this->actor = $actor;
    }

    public function getActor(): Person
    {
        return $this->actor;
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

    public function setMusicBy(?Person $musicBy): void
    {
        $this->musicBy = $musicBy;
    }

    public function getMusicBy(): ?Person
    {
        return $this->musicBy;
    }
}

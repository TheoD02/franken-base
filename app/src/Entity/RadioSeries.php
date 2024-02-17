<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CreativeWorkSeries dedicated to radio broadcast and associated online delivery.
 *
 * @see https://schema.org/RadioSeries
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RadioSeries'])]
class RadioSeries extends CreativeWorkSeries
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

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
 * A podcast is an episodic series of digital audio or video files which a user can download and listen to.
 *
 * @see https://schema.org/PodcastSeries
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PodcastSeries'])]
class PodcastSeries extends CreativeWorkSeries
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
	 * The URL for a feed, e.g. associated with a podcast series, blog, or series of date-stamped updates. This is usually RSS or Atom.
	 *
	 * @see https://schema.org/webFeed
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DataFeed')]
	#[ApiProperty(types: ['https://schema.org/webFeed'])]
	private ?DataFeed $webFeed = null;

	public function setActor(Person $actor): void
	{
		$this->actor = $actor;
	}

	public function getActor(): Person
	{
		return $this->actor;
	}

	public function setWebFeed(?DataFeed $webFeed): void
	{
		$this->webFeed = $webFeed;
	}

	public function getWebFeed(): ?DataFeed
	{
		return $this->webFeed;
	}
}

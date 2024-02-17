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
 * An audiobook.
 *
 * @see https://schema.org/Audiobook
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Audiobook'])]
class Audiobook extends Book
{
	/**
	 * A person who reads (performs) the audiobook.
	 *
	 * @see https://schema.org/readBy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/readBy'])]
	#[Assert\NotNull]
	private Person $readBy;

	/**
	 * The duration of the item (movie, audio recording, event, etc.) in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601).
	 *
	 * @see https://schema.org/duration
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
	#[ApiProperty(types: ['https://schema.org/duration'])]
	private ?Duration $duration = null;

	public function setReadBy(Person $readBy): void
	{
		$this->readBy = $readBy;
	}

	public function getReadBy(): Person
	{
		return $this->readBy;
	}

	public function setDuration(?Duration $duration): void
	{
		$this->duration = $duration;
	}

	public function getDuration(): ?Duration
	{
		return $this->duration;
	}
}

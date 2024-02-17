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
 * A musical group, such as a band, an orchestra, or a choir. Can also be a solo musician.
 *
 * @see https://schema.org/MusicGroup
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MusicGroup'])]
class MusicGroup extends PerformingGroup
{
	/**
	 * A music recording (track)—usually a single song. If an ItemList is given, the list should contain items of type MusicRecording.
	 *
	 * @see https://schema.org/track
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ItemList')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/track'])]
	#[Assert\NotNull]
	private ItemList $track;

	/**
	 * A music album.
	 *
	 * @see https://schema.org/album
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MusicAlbum')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/album'])]
	#[Assert\NotNull]
	private MusicAlbum $album;

	/**
	 * Genre of the creative work, broadcast channel or group.
	 *
	 * @see https://schema.org/genre
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/genre'])]
	#[Assert\Url]
	private ?string $genre = null;

	public function setTrack(ItemList $track): void
	{
		$this->track = $track;
	}

	public function getTrack(): ItemList
	{
		return $this->track;
	}

	public function setAlbum(MusicAlbum $album): void
	{
		$this->album = $album;
	}

	public function getAlbum(): MusicAlbum
	{
		return $this->album;
	}

	public function setGenre(?string $genre): void
	{
		$this->genre = $genre;
	}

	public function getGenre(): ?string
	{
		return $this->genre;
	}
}

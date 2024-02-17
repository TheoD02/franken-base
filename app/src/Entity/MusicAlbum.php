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
use App\Enum\MusicAlbumProductionType;
use App\Enum\MusicAlbumReleaseType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A collection of music tracks.
 *
 * @see https://schema.org/MusicAlbum
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MusicAlbum'])]
class MusicAlbum extends MusicPlaylist
{
	/**
	 * Classification of the album by its type of content: soundtrack, live album, studio album, etc.
	 *
	 * @see https://schema.org/albumProductionType
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/albumProductionType'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [MusicAlbumProductionType::class, 'toArray'])]
	private string $albumProductionType;

	/**
	 * The kind of release which this album is: single, EP or album.
	 *
	 * @see https://schema.org/albumReleaseType
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/albumReleaseType'])]
	#[Assert\Choice(callback: [MusicAlbumReleaseType::class, 'toArray'])]
	private ?string $albumReleaseType = null;

	/**
	 * The artist that performed this album or recording.
	 *
	 * @see https://schema.org/byArtist
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ApiProperty(types: ['https://schema.org/byArtist'])]
	private ?Person $byArtist = null;

	/**
	 * A release of this album.
	 *
	 * @see https://schema.org/albumRelease
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MusicRelease')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/albumRelease'])]
	#[Assert\NotNull]
	private MusicRelease $albumRelease;

	public function setAlbumProductionType(string $albumProductionType): void
	{
		$this->albumProductionType = $albumProductionType;
	}

	public function getAlbumProductionType(): string
	{
		return $this->albumProductionType;
	}

	public function setAlbumReleaseType(?string $albumReleaseType): void
	{
		$this->albumReleaseType = $albumReleaseType;
	}

	public function getAlbumReleaseType(): ?string
	{
		return $this->albumReleaseType;
	}

	public function setByArtist(?Person $byArtist): void
	{
		$this->byArtist = $byArtist;
	}

	public function getByArtist(): ?Person
	{
		return $this->byArtist;
	}

	public function setAlbumRelease(MusicRelease $albumRelease): void
	{
		$this->albumRelease = $albumRelease;
	}

	public function getAlbumRelease(): MusicRelease
	{
		return $this->albumRelease;
	}
}

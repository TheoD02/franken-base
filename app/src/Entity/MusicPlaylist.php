<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A collection of music tracks in playlist form.
 *
 * @see https://schema.org/MusicPlaylist
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['musicPlaylist' => MusicPlaylist::class, 'musicRelease' => MusicRelease::class, 'musicAlbum' => MusicAlbum::class])]
class MusicPlaylist extends CreativeWork
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
     * The number of tracks in this album or playlist.
     *
     * @see https://schema.org/numTracks
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/numTracks'])]
    private ?int $numTracks = null;

    public function setTrack(ItemList $track): void
    {
        $this->track = $track;
    }

    public function getTrack(): ItemList
    {
        return $this->track;
    }

    public function setNumTracks(?int $numTracks): void
    {
        $this->numTracks = $numTracks;
    }

    public function getNumTracks(): ?int
    {
        return $this->numTracks;
    }
}

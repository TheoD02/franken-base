<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The term "story" is any indivisible, re-printable unit of a comic, including the interior stories, covers, and backmatter. Most comics have at least two stories: a cover (ComicCoverArt) and an interior story.
 *
 * @see https://schema.org/ComicStory
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ComicStory'])]
class ComicStory extends CreativeWork
{
    /**
     * The individual who adds lettering, including speech balloons and sound effects, to artwork.
     *
     * @see https://schema.org/letterer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/letterer'])]
    private ?Person $letterer = null;

    /**
     * The individual who traces over the pencil drawings in ink after pencils are complete.
     *
     * @see https://schema.org/inker
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/inker'])]
    private ?Person $inker = null;

    /**
     * The individual who draws the primary narrative artwork.
     *
     * @see https://schema.org/penciler
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/penciler'])]
    private ?Person $penciler = null;

    /**
     * The individual who adds color to inked drawings.
     *
     * @see https://schema.org/colorist
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/colorist'])]
    private ?Person $colorist = null;

    /**
     * The primary artist for a work in a medium other than pencils or digital line art--for example, if the primary artwork is done in watercolors or digital paints.
     *
     * @see https://schema.org/artist
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/artist'])]
    private ?Person $artist = null;

    public function setLetterer(?Person $letterer): void
    {
        $this->letterer = $letterer;
    }

    public function getLetterer(): ?Person
    {
        return $this->letterer;
    }

    public function setInker(?Person $inker): void
    {
        $this->inker = $inker;
    }

    public function getInker(): ?Person
    {
        return $this->inker;
    }

    public function setPenciler(?Person $penciler): void
    {
        $this->penciler = $penciler;
    }

    public function getPenciler(): ?Person
    {
        return $this->penciler;
    }

    public function setColorist(?Person $colorist): void
    {
        $this->colorist = $colorist;
    }

    public function getColorist(): ?Person
    {
        return $this->colorist;
    }

    public function setArtist(?Person $artist): void
    {
        $this->artist = $artist;
    }

    public function getArtist(): ?Person
    {
        return $this->artist;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * A work of art that is primarily visual in character.
 *
 * @see https://schema.org/VisualArtwork
 */
#[ORM\MappedSuperclass]
abstract class VisualArtwork extends CreativeWork
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
     * The number of copies when multiple copies of a piece of artwork are produced - e.g. for a limited edition of 20 prints, 'artEdition' refers to the total number of copies (in this example "20").
     *
     * @see https://schema.org/artEdition
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/artEdition'])]
    private ?string $artEdition = null;

    /**
     * e.g. Painting, Drawing, Sculpture, Print, Photograph, Assemblage, Collage, etc.
     *
     * @see https://schema.org/artform
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/artform'])]
    private ?string $artform = null;

    /**
     * The width of the item.
     *
     * @see https://schema.org/width
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/width'])]
    private ?QuantitativeValue $width = null;

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
     * The supporting materials for the artwork, e.g. Canvas, Paper, Wood, Board, etc.
     *
     * @see https://schema.org/artworkSurface
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/artworkSurface'])]
    private ?string $artworkSurface = null;

    /**
     * The material used. (E.g. Oil, Watercolour, Acrylic, Linoprint, Marble, Cyanotype, Digital, Lithograph, DryPoint, Intaglio, Pastel, Woodcut, Pencil, Mixed Media, etc.).
     *
     * @see https://schema.org/artMedium
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/artMedium'])]
    private ?string $artMedium = null;

    /**
     * The primary artist for a work in a medium other than pencils or digital line art--for example, if the primary artwork is done in watercolors or digital paints.
     *
     * @see https://schema.org/artist
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ApiProperty(types: ['https://schema.org/artist'])]
    private ?Person $artist = null;

    /**
     * The height of the item.
     *
     * @see https://schema.org/height
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/height'])]
    private ?QuantitativeValue $height = null;

    /**
     * The depth of the item.
     *
     * @see https://schema.org/depth
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/depth'])]
    private ?QuantitativeValue $depth = null;

    public function setLetterer(?Person $letterer): void
    {
        $this->letterer = $letterer;
    }

    public function getLetterer(): ?Person
    {
        return $this->letterer;
    }

    public function setArtEdition(?string $artEdition): void
    {
        $this->artEdition = $artEdition;
    }

    public function getArtEdition(): ?string
    {
        return $this->artEdition;
    }

    public function setArtform(?string $artform): void
    {
        $this->artform = $artform;
    }

    public function getArtform(): ?string
    {
        return $this->artform;
    }

    public function setWidth(?QuantitativeValue $width): void
    {
        $this->width = $width;
    }

    public function getWidth(): ?QuantitativeValue
    {
        return $this->width;
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

    public function setArtworkSurface(?string $artworkSurface): void
    {
        $this->artworkSurface = $artworkSurface;
    }

    public function getArtworkSurface(): ?string
    {
        return $this->artworkSurface;
    }

    public function setArtMedium(?string $artMedium): void
    {
        $this->artMedium = $artMedium;
    }

    public function getArtMedium(): ?string
    {
        return $this->artMedium;
    }

    public function setArtist(?Person $artist): void
    {
        $this->artist = $artist;
    }

    public function getArtist(): ?Person
    {
        return $this->artist;
    }

    public function setHeight(?QuantitativeValue $height): void
    {
        $this->height = $height;
    }

    public function getHeight(): ?QuantitativeValue
    {
        return $this->height;
    }

    public function setDepth(?QuantitativeValue $depth): void
    {
        $this->depth = $depth;
    }

    public function getDepth(): ?QuantitativeValue
    {
        return $this->depth;
    }
}

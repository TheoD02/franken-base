<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Individual comic issues are serially published as part of a larger series. For the sake of consistency, even one-shot issues belong to a series comprised of a single issue. All comic issues can be uniquely identified by: the combination of the name and volume number of the series to which the issue belongs; the issue number; and the variant description of the issue (if any).
 *
 * @see https://schema.org/ComicIssue
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ComicIssue'])]
class ComicIssue extends PublicationIssue
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
     * A description of the variant cover for the issue, if the issue is a variant printing. For example, "Bryan Hitch Variant Cover" or "2nd Printing Variant".
     *
     * @see https://schema.org/variantCover
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/variantCover'])]
    private ?string $variantCover = null;

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

    public function setVariantCover(?string $variantCover): void
    {
        $this->variantCover = $variantCover;
    }

    public function getVariantCover(): ?string
    {
        return $this->variantCover;
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

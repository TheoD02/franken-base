<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * The geographic shape of a place. A GeoShape can be described using several properties whose values are based on latitude/longitude pairs. Either whitespace or commas can be used to separate latitude and longitude; whitespace should be used when writing a list of several such points.
 *
 * @see https://schema.org/GeoShape
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['geoShape' => GeoShape::class, 'geoCircle' => GeoCircle::class])]
class GeoShape extends StructuredValue
{
    /**
     * Physical address of the item.
     *
     * @see https://schema.org/address
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/address'])]
    private ?string $address = null;

    /**
     * The country. For example, USA. You can also provide the two-letter \[ISO 3166-1 alpha-2 country code\](http://en.wikipedia.org/wiki/ISO\_3166-1).
     *
     * @see https://schema.org/addressCountry
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Country')]
    #[ApiProperty(types: ['https://schema.org/addressCountry'])]
    private ?Country $addressCountry = null;

    /**
     * A circle is the circular region of a specified radius centered at a specified latitude and longitude. A circle is expressed as a pair followed by a radius in meters.
     *
     * @see https://schema.org/circle
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/circle'])]
    private ?string $circle = null;

    /**
     * The postal code. For example, 94043.
     *
     * @see https://schema.org/postalCode
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/postalCode'])]
    private ?string $postalCode = null;

    /**
     * The elevation of a location (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)). Values may be of the form 'NUMBER UNIT\\\_OF\\\_MEASUREMENT' (e.g., '1,000 m', '3,200 ft') while numbers alone should be assumed to be a value in meters.
     *
     * @see https://schema.org/elevation
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/elevation'])]
    private ?string $elevation = null;

    /**
     * A box is the area enclosed by the rectangle formed by two points. The first point is the lower corner, the second point is the upper corner. A box is expressed as two points separated by a space character.
     *
     * @see https://schema.org/box
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/box'])]
    private ?string $box = null;

    /**
     * A polygon is the area enclosed by a point-to-point path for which the starting and ending points are the same. A polygon is expressed as a series of four or more space delimited points where the first and final points are identical.
     *
     * @see https://schema.org/polygon
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/polygon'])]
    private ?string $polygon = null;

    /**
     * A line is a point-to-point path consisting of two or more points. A line is expressed as a series of two or more point objects separated by space.
     *
     * @see https://schema.org/line
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/line'])]
    private ?string $line = null;

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddressCountry(?Country $addressCountry): void
    {
        $this->addressCountry = $addressCountry;
    }

    public function getAddressCountry(): ?Country
    {
        return $this->addressCountry;
    }

    public function setCircle(?string $circle): void
    {
        $this->circle = $circle;
    }

    public function getCircle(): ?string
    {
        return $this->circle;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setElevation(?string $elevation): void
    {
        $this->elevation = $elevation;
    }

    public function getElevation(): ?string
    {
        return $this->elevation;
    }

    public function setBox(?string $box): void
    {
        $this->box = $box;
    }

    public function getBox(): ?string
    {
        return $this->box;
    }

    public function setPolygon(?string $polygon): void
    {
        $this->polygon = $polygon;
    }

    public function getPolygon(): ?string
    {
        return $this->polygon;
    }

    public function setLine(?string $line): void
    {
        $this->line = $line;
    }

    public function getLine(): ?string
    {
        return $this->line;
    }
}

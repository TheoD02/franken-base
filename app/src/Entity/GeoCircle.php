<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A GeoCircle is a GeoShape representing a circular geographic area. As it is a GeoShape it provides the simple textual property 'circle', but also allows the combination of postalCode alongside geoRadius. The center of the circle can be indicated via the 'geoMidpoint' property, or more approximately using 'address', 'postalCode'.
 *
 * @see https://schema.org/GeoCircle
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GeoCircle'])]
class GeoCircle extends GeoShape
{
    /**
     * Indicates the approximate radius of a GeoCircle (metres unless indicated otherwise via Distance notation).
     *
     * @see https://schema.org/geoRadius
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Distance')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/geoRadius'])]
    #[Assert\NotNull]
    private Distance $geoRadius;

    /**
     * Indicates the GeoCoordinates at the centre of a GeoShape, e.g. GeoCircle.
     *
     * @see https://schema.org/geoMidpoint
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\GeoCoordinates')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/geoMidpoint'])]
    #[Assert\NotNull]
    private GeoCoordinates $geoMidpoint;

    public function setGeoRadius(Distance $geoRadius): void
    {
        $this->geoRadius = $geoRadius;
    }

    public function getGeoRadius(): Distance
    {
        return $this->geoRadius;
    }

    public function setGeoMidpoint(GeoCoordinates $geoMidpoint): void
    {
        $this->geoMidpoint = $geoMidpoint;
    }

    public function getGeoMidpoint(): GeoCoordinates
    {
        return $this->geoMidpoint;
    }
}

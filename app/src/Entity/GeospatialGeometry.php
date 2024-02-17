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
 * (Eventually to be defined as) a supertype of GeoShape designed to accommodate definitions from Geo-Spatial best practices.
 *
 * @see https://schema.org/GeospatialGeometry
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GeospatialGeometry'])]
class GeospatialGeometry extends Intangible
{
	/**
	 * Represents a relationship between two geometries (or the places they represent), relating a geometry to another that crosses it: "a crosses b: they have some but not all interior points in common, and the dimension of the intersection is less than that of at least one of them". As defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM).
	 *
	 * @see https://schema.org/geoCrosses
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\GeospatialGeometry')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoCrosses'])]
	#[Assert\NotNull]
	private GeospatialGeometry $geoCrosses;

	/**
	 * Represents a relationship between two geometries (or the places they represent), relating a containing geometry to a contained geometry. "a contains b iff no points of b lie in the exterior of a, and at least one point of the interior of b lies in the interior of a". As defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM).
	 *
	 * @see https://schema.org/geoContains
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\GeospatialGeometry')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoContains'])]
	#[Assert\NotNull]
	private GeospatialGeometry $geoContains;

	/**
	 * Represents a relationship between two geometries (or the places they represent), relating a covering geometry to a covered geometry. "Every point of b is a point of (the interior or boundary of) a". As defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM).
	 *
	 * @see https://schema.org/geoCovers
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\GeospatialGeometry')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoCovers'])]
	#[Assert\NotNull]
	private GeospatialGeometry $geoCovers;

	/**
	 * Represents spatial relations in which two geometries (or the places they represent) are topologically equal, as defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM). "Two geometries are topologically equal if their interiors intersect and no part of the interior or boundary of one geometry intersects the exterior of the other" (a symmetric relationship).
	 *
	 * @see https://schema.org/geoEquals
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoEquals'])]
	#[Assert\NotNull]
	private Place $geoEquals;

	/**
	 * Represents spatial relations in which two geometries (or the places they represent) have at least one point in common. As defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM).
	 *
	 * @see https://schema.org/geoIntersects
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoIntersects'])]
	#[Assert\NotNull]
	private Place $geoIntersects;

	/**
	 * Represents a relationship between two geometries (or the places they represent), relating a geometry to another that covers it. As defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM).
	 *
	 * @see https://schema.org/geoCoveredBy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoCoveredBy'])]
	#[Assert\NotNull]
	private Place $geoCoveredBy;

	/**
	 * Represents a relationship between two geometries (or the places they represent), relating a geometry to another that geospatially overlaps it, i.e. they have some but not all points in common. As defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM).
	 *
	 * @see https://schema.org/geoOverlaps
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoOverlaps'])]
	#[Assert\NotNull]
	private Place $geoOverlaps;

	/**
	 * Represents spatial relations in which two geometries (or the places they represent) are topologically disjoint: "they have no point in common. They form a set of disconnected geometries." (A symmetric relationship, as defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM).)
	 *
	 * @see https://schema.org/geoDisjoint
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\GeospatialGeometry')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoDisjoint'])]
	#[Assert\NotNull]
	private GeospatialGeometry $geoDisjoint;

	/**
	 * Represents spatial relations in which two geometries (or the places they represent) touch: "they have at least one boundary point in common, but no interior points." (A symmetric relationship, as defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM).)
	 *
	 * @see https://schema.org/geoTouches
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoTouches'])]
	#[Assert\NotNull]
	private Place $geoTouches;

	/**
	 * Represents a relationship between two geometries (or the places they represent), relating a geometry to one that contains it, i.e. it is inside (i.e. within) its interior. As defined in \[DE-9IM\](https://en.wikipedia.org/wiki/DE-9IM).
	 *
	 * @see https://schema.org/geoWithin
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/geoWithin'])]
	#[Assert\NotNull]
	private Place $geoWithin;

	public function setGeoCrosses(GeospatialGeometry $geoCrosses): void
	{
		$this->geoCrosses = $geoCrosses;
	}

	public function getGeoCrosses(): GeospatialGeometry
	{
		return $this->geoCrosses;
	}

	public function setGeoContains(GeospatialGeometry $geoContains): void
	{
		$this->geoContains = $geoContains;
	}

	public function getGeoContains(): GeospatialGeometry
	{
		return $this->geoContains;
	}

	public function setGeoCovers(GeospatialGeometry $geoCovers): void
	{
		$this->geoCovers = $geoCovers;
	}

	public function getGeoCovers(): GeospatialGeometry
	{
		return $this->geoCovers;
	}

	public function setGeoEquals(Place $geoEquals): void
	{
		$this->geoEquals = $geoEquals;
	}

	public function getGeoEquals(): Place
	{
		return $this->geoEquals;
	}

	public function setGeoIntersects(Place $geoIntersects): void
	{
		$this->geoIntersects = $geoIntersects;
	}

	public function getGeoIntersects(): Place
	{
		return $this->geoIntersects;
	}

	public function setGeoCoveredBy(Place $geoCoveredBy): void
	{
		$this->geoCoveredBy = $geoCoveredBy;
	}

	public function getGeoCoveredBy(): Place
	{
		return $this->geoCoveredBy;
	}

	public function setGeoOverlaps(Place $geoOverlaps): void
	{
		$this->geoOverlaps = $geoOverlaps;
	}

	public function getGeoOverlaps(): Place
	{
		return $this->geoOverlaps;
	}

	public function setGeoDisjoint(GeospatialGeometry $geoDisjoint): void
	{
		$this->geoDisjoint = $geoDisjoint;
	}

	public function getGeoDisjoint(): GeospatialGeometry
	{
		return $this->geoDisjoint;
	}

	public function setGeoTouches(Place $geoTouches): void
	{
		$this->geoTouches = $geoTouches;
	}

	public function getGeoTouches(): Place
	{
		return $this->geoTouches;
	}

	public function setGeoWithin(Place $geoWithin): void
	{
		$this->geoWithin = $geoWithin;
	}

	public function getGeoWithin(): Place
	{
		return $this->geoWithin;
	}
}

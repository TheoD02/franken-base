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
 * Entities that have a somewhat fixed, physical extension.
 *
 * @see https://schema.org/Place
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'place' => Place::class,
	'landmarksOrHistoricalBuildings' => LandmarksOrHistoricalBuildings::class,
	'accommodation' => Accommodation::class,
	'civicStructure' => CivicStructure::class,
	'touristDestination' => TouristDestination::class,
	'touristAttraction' => TouristAttraction::class,
	'administrativeArea' => AdministrativeArea::class,
	'campingPitch' => CampingPitch::class,
	'apartment' => Apartment::class,
	'suite' => Suite::class,
	'park' => Park::class,
	'taxiStand' => TaxiStand::class,
	'stadiumOrArena' => StadiumOrArena::class,
	'publicToilet' => PublicToilet::class,
	'subwayStation' => SubwayStation::class,
	'playground' => Playground::class,
	'zoo' => Zoo::class,
	'aquarium' => Aquarium::class,
	'bridge' => Bridge::class,
	'musicVenue' => MusicVenue::class,
	'cemetery' => Cemetery::class,
	'performingArtsTheater' => PerformingArtsTheater::class,
	'parkingFacility' => ParkingFacility::class,
	'eventVenue' => EventVenue::class,
	'crematorium' => Crematorium::class,
	'RVPark' => RVPark::class,
	'museum' => Museum::class,
	'beach' => Beach::class,
	'boatTerminal' => BoatTerminal::class,
	'trainStation' => TrainStation::class,
	'busStop' => BusStop::class,
	'airport' => Airport::class,
	'busStation' => BusStation::class,
	'schoolDistrict' => SchoolDistrict::class,
	'city' => City::class,
	'state' => State::class,
	'country' => Country::class,
	'volcano' => Volcano::class,
	'continent' => Continent::class,
	'mountain' => Mountain::class,
	'gatedResidenceCommunity' => GatedResidenceCommunity::class,
	'apartmentComplex' => ApartmentComplex::class,
	'meetingRoom' => MeetingRoom::class,
	'hotelRoom' => HotelRoom::class,
	'singleFamilyResidence' => SingleFamilyResidence::class,
	'cityHall' => CityHall::class,
	'courthouse' => Courthouse::class,
	'legislativeBuilding' => LegislativeBuilding::class,
	'defenceEstablishment' => DefenceEstablishment::class,
	'embassy' => Embassy::class,
	'synagogue' => Synagogue::class,
	'mosque' => Mosque::class,
	'hinduTemple' => HinduTemple::class,
	'buddhistTemple' => BuddhistTemple::class,
	'seaBodyOfWater' => SeaBodyOfWater::class,
	'lakeBodyOfWater' => LakeBodyOfWater::class,
	'oceanBodyOfWater' => OceanBodyOfWater::class,
	'waterfall' => Waterfall::class,
	'pond' => Pond::class,
	'canal' => Canal::class,
	'reservoir' => Reservoir::class,
	'riverBodyOfWater' => RiverBodyOfWater::class,
	'catholicChurch' => CatholicChurch::class,
])]
class Place extends Thing
{
	/**
	 * Indicates whether some facility (e.g. \[\[FoodEstablishment\]\], \[\[CovidTestingFacility\]\]) offers a service that can be used by driving through in a car. In the case of \[\[CovidTestingFacility\]\] such facilities could potentially help with social distancing from other potentially-infected users.
	 *
	 * @see https://schema.org/hasDriveThroughService
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/hasDriveThroughService'])]
	private ?bool $hasDriveThroughService = null;

	/**
	 * @var Collection<Text>|null The International Standard of Industrial Classification of All Economic Activities (ISIC), Revision 4 code for a particular organization, business person, or place.
	 * @see https://schema.org/isicV4
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'place_text_isic_v4')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/isicV4'])]
	private ?Collection $isicV4 = null;

	/**
	 * Physical address of the item.
	 *
	 * @see https://schema.org/address
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/address'])]
	private ?string $address = null;

	/**
	 * A photograph of this place.
	 *
	 * @see https://schema.org/photo
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Photograph')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/photo'])]
	#[Assert\NotNull]
	private Photograph $photo;

	/**
	 * Certification information about a product, organization, service, place, or person.
	 *
	 * @see https://schema.org/hasCertification
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Certification')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasCertification'])]
	#[Assert\NotNull]
	private Certification $hasCertification;

	/**
	 * The basic containment relation between a place and one that contains it.
	 *
	 * @see https://schema.org/containedInPlace
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ApiProperty(types: ['https://schema.org/containedInPlace'])]
	private ?Place $containedInPlace = null;

	/**
	 * An associated logo.
	 *
	 * @see https://schema.org/logo
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/logo'])]
	#[Assert\Url]
	private ?string $logo = null;

	/**
	 * Indicates whether it is allowed to smoke in the place, e.g. in the restaurant, hotel or hotel room.
	 *
	 * @see https://schema.org/smokingAllowed
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/smokingAllowed'])]
	private ?bool $smokingAllowed = null;

	/**
	 * A property-value pair representing an additional characteristic of the entity, e.g. a product feature or another characteristic for which there is no matching property in schema.org.\\n\\nNote: Publishers should be aware that applications designed to use specific schema.org properties (e.g. https://schema.org/width, https://schema.org/color, https://schema.org/gtin13, ...) will typically expect such data to be provided using those properties, rather than using the generic property/value mechanism.
	 *
	 * @see https://schema.org/additionalProperty
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PropertyValue')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/additionalProperty'])]
	#[Assert\NotNull]
	private PropertyValue $additionalProperty;

	/**
	 * A short textual code (also called "store code") that uniquely identifies a place of business. The code is typically assigned by the parentOrganization and used in structured URLs.\\n\\nFor example, in the URL http://www.starbucks.co.uk/store-locator/etc/detail/3047 the code "3047" is a branchCode for a particular branch.
	 *
	 * @see https://schema.org/branchCode
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/branchCode'])]
	private ?string $branchCode = null;

	/**
	 * The special opening hours of a certain place.\\n\\nUse this to explicitly override general opening hours brought in scope by \[\[openingHoursSpecification\]\] or \[\[openingHours\]\].
	 *
	 * @see https://schema.org/specialOpeningHoursSpecification
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\OpeningHoursSpecification')]
	#[ApiProperty(types: ['https://schema.org/specialOpeningHoursSpecification'])]
	private ?OpeningHoursSpecification $specialOpeningHoursSpecification = null;

	/**
	 * The telephone number.
	 *
	 * @see https://schema.org/telephone
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/telephone'])]
	private ?string $telephone = null;

	/**
	 * A URL to a map of the place.
	 *
	 * @see https://schema.org/hasMap
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Map')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasMap'])]
	#[Assert\NotNull]
	private Map $hasMap;

	/**
	 * The latitude of a location. For example ```37.42242``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
	 *
	 * @see https://schema.org/latitude
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/latitude'])]
	private ?string $latitude = null;

	/**
	 * The overall rating, based on a collection of reviews or ratings, of the item.
	 *
	 * @see https://schema.org/aggregateRating
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AggregateRating')]
	#[ApiProperty(types: ['https://schema.org/aggregateRating'])]
	private ?AggregateRating $aggregateRating = null;

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
	 * The longitude of a location. For example ```-122.08585``` (\[WGS 84\](https://en.wikipedia.org/wiki/World\_Geodetic\_System)).
	 *
	 * @see https://schema.org/longitude
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/longitude'])]
	private ?string $longitude = null;

	/**
	 * Keywords or tags used to describe some item. Multiple textual entries in a keywords list are typically delimited by commas, or by repeating the property.
	 *
	 * @see https://schema.org/keywords
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/keywords'])]
	private ?string $keywords = null;

	/**
	 * The fax number.
	 *
	 * @see https://schema.org/faxNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/faxNumber'])]
	private ?string $faxNumber = null;

	/**
	 * The geo coordinates of the place.
	 *
	 * @see https://schema.org/geo
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\GeoShape')]
	#[ApiProperty(types: ['https://schema.org/geo'])]
	private ?GeoShape $geo = null;

	/**
	 * The \[Global Location Number\](http://www.gs1.org/gln) (GLN, sometimes also referred to as International Location Number or ILN) of the respective organization, person, or place. The GLN is a 13-digit number used to identify parties and physical locations.
	 *
	 * @see https://schema.org/globalLocationNumber
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/globalLocationNumber'])]
	private ?string $globalLocationNumber = null;

	/**
	 * @var Collection<OpeningHoursSpecification>|null The opening hours of a certain place.
	 * @see https://schema.org/openingHoursSpecification
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\OpeningHoursSpecification')]
	#[ORM\JoinTable(name: 'place_opening_hours_specification_opening_hours_specification')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/openingHoursSpecification'])]
	private ?Collection $openingHoursSpecification = null;

	/**
	 * The total number of individuals that may attend an event or venue.
	 *
	 * @see https://schema.org/maximumAttendeeCapacity
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
	#[ApiProperty(types: ['https://schema.org/maximumAttendeeCapacity'])]
	private ?int $maximumAttendeeCapacity = null;

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
	 * A slogan or motto associated with the item.
	 *
	 * @see https://schema.org/slogan
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/slogan'])]
	private ?string $slogan = null;

	/**
	 * A flag to signal that the \[\[Place\]\] is open to public visitors. If this property is omitted there is no assumed default boolean value.
	 *
	 * @see https://schema.org/publicAccess
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/publicAccess'])]
	private ?bool $publicAccess = null;

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
	 * A review of the item.
	 *
	 * @see https://schema.org/review
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Review')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/review'])]
	#[Assert\NotNull]
	private Review $review;

	/**
	 * A flag to signal that the item, event, or place is accessible for free.
	 *
	 * @see https://schema.org/isAccessibleForFree
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/isAccessibleForFree'])]
	private ?bool $isAccessibleForFree = null;

	/**
	 * Upcoming or past event associated with this place, organization, or action.
	 *
	 * @see https://schema.org/event
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Event')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/event'])]
	#[Assert\NotNull]
	private Event $event;

	/**
	 * A page providing information on how to book a tour of some \[\[Place\]\], such as an \[\[Accommodation\]\] or \[\[ApartmentComplex\]\] in a real estate setting, as well as other kinds of tours as appropriate.
	 *
	 * @see https://schema.org/tourBookingPage
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/tourBookingPage'])]
	#[Assert\Url]
	private ?string $tourBookingPage = null;

	/**
	 * An amenity feature (e.g. a characteristic or service) of the Accommodation. This generic property does not make a statement about whether the feature is included in an offer for the main accommodation or available at extra costs.
	 *
	 * @see https://schema.org/amenityFeature
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\LocationFeatureSpecification')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/amenityFeature'])]
	#[Assert\NotNull]
	private LocationFeatureSpecification $amenityFeature;

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

	/**
	 * The basic containment relation between a place and another that it contains.
	 *
	 * @see https://schema.org/containsPlace
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ApiProperty(types: ['https://schema.org/containsPlace'])]
	private ?Place $containsPlace = null;

	function __construct()
	{
		$this->isicV4 = new ArrayCollection();
		$this->openingHoursSpecification = new ArrayCollection();
	}

	public function setHasDriveThroughService(?bool $hasDriveThroughService): void
	{
		$this->hasDriveThroughService = $hasDriveThroughService;
	}

	public function getHasDriveThroughService(): ?bool
	{
		return $this->hasDriveThroughService;
	}

	public function addIsicV4(string $isicV4): void
	{
		$this->isicV4[] = $isicV4;
	}

	public function removeIsicV4(string $isicV4): void
	{
		$this->isicV4->removeElement($isicV4);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getIsicV4(): Collection
	{
		return $this->isicV4;
	}

	public function setAddress(?string $address): void
	{
		$this->address = $address;
	}

	public function getAddress(): ?string
	{
		return $this->address;
	}

	public function setPhoto(Photograph $photo): void
	{
		$this->photo = $photo;
	}

	public function getPhoto(): Photograph
	{
		return $this->photo;
	}

	public function setHasCertification(Certification $hasCertification): void
	{
		$this->hasCertification = $hasCertification;
	}

	public function getHasCertification(): Certification
	{
		return $this->hasCertification;
	}

	public function setContainedInPlace(?Place $containedInPlace): void
	{
		$this->containedInPlace = $containedInPlace;
	}

	public function getContainedInPlace(): ?Place
	{
		return $this->containedInPlace;
	}

	public function setLogo(?string $logo): void
	{
		$this->logo = $logo;
	}

	public function getLogo(): ?string
	{
		return $this->logo;
	}

	public function setSmokingAllowed(?bool $smokingAllowed): void
	{
		$this->smokingAllowed = $smokingAllowed;
	}

	public function getSmokingAllowed(): ?bool
	{
		return $this->smokingAllowed;
	}

	public function setAdditionalProperty(PropertyValue $additionalProperty): void
	{
		$this->additionalProperty = $additionalProperty;
	}

	public function getAdditionalProperty(): PropertyValue
	{
		return $this->additionalProperty;
	}

	public function setBranchCode(?string $branchCode): void
	{
		$this->branchCode = $branchCode;
	}

	public function getBranchCode(): ?string
	{
		return $this->branchCode;
	}

	public function setSpecialOpeningHoursSpecification(
		?OpeningHoursSpecification $specialOpeningHoursSpecification,
	): void
	{
		$this->specialOpeningHoursSpecification = $specialOpeningHoursSpecification;
	}

	public function getSpecialOpeningHoursSpecification(): ?OpeningHoursSpecification
	{
		return $this->specialOpeningHoursSpecification;
	}

	public function setTelephone(?string $telephone): void
	{
		$this->telephone = $telephone;
	}

	public function getTelephone(): ?string
	{
		return $this->telephone;
	}

	public function setHasMap(Map $hasMap): void
	{
		$this->hasMap = $hasMap;
	}

	public function getHasMap(): Map
	{
		return $this->hasMap;
	}

	public function setLatitude(?string $latitude): void
	{
		$this->latitude = $latitude;
	}

	public function getLatitude(): ?string
	{
		return $this->latitude;
	}

	public function setAggregateRating(?AggregateRating $aggregateRating): void
	{
		$this->aggregateRating = $aggregateRating;
	}

	public function getAggregateRating(): ?AggregateRating
	{
		return $this->aggregateRating;
	}

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

	public function setLongitude(?string $longitude): void
	{
		$this->longitude = $longitude;
	}

	public function getLongitude(): ?string
	{
		return $this->longitude;
	}

	public function setKeywords(?string $keywords): void
	{
		$this->keywords = $keywords;
	}

	public function getKeywords(): ?string
	{
		return $this->keywords;
	}

	public function setFaxNumber(?string $faxNumber): void
	{
		$this->faxNumber = $faxNumber;
	}

	public function getFaxNumber(): ?string
	{
		return $this->faxNumber;
	}

	public function setGeo(?GeoShape $geo): void
	{
		$this->geo = $geo;
	}

	public function getGeo(): ?GeoShape
	{
		return $this->geo;
	}

	public function setGlobalLocationNumber(?string $globalLocationNumber): void
	{
		$this->globalLocationNumber = $globalLocationNumber;
	}

	public function getGlobalLocationNumber(): ?string
	{
		return $this->globalLocationNumber;
	}

	public function addOpeningHoursSpecification(OpeningHoursSpecification $openingHoursSpecification): void
	{
		$this->openingHoursSpecification[] = $openingHoursSpecification;
	}

	public function removeOpeningHoursSpecification(OpeningHoursSpecification $openingHoursSpecification): void
	{
		$this->openingHoursSpecification->removeElement($openingHoursSpecification);
	}

	/**
	 * @return Collection<OpeningHoursSpecification>|null
	 */
	public function getOpeningHoursSpecification(): Collection
	{
		return $this->openingHoursSpecification;
	}

	public function setMaximumAttendeeCapacity(?int $maximumAttendeeCapacity): void
	{
		$this->maximumAttendeeCapacity = $maximumAttendeeCapacity;
	}

	public function getMaximumAttendeeCapacity(): ?int
	{
		return $this->maximumAttendeeCapacity;
	}

	public function setGeoCovers(GeospatialGeometry $geoCovers): void
	{
		$this->geoCovers = $geoCovers;
	}

	public function getGeoCovers(): GeospatialGeometry
	{
		return $this->geoCovers;
	}

	public function setSlogan(?string $slogan): void
	{
		$this->slogan = $slogan;
	}

	public function getSlogan(): ?string
	{
		return $this->slogan;
	}

	public function setPublicAccess(?bool $publicAccess): void
	{
		$this->publicAccess = $publicAccess;
	}

	public function getPublicAccess(): ?bool
	{
		return $this->publicAccess;
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

	public function setReview(Review $review): void
	{
		$this->review = $review;
	}

	public function getReview(): Review
	{
		return $this->review;
	}

	public function setIsAccessibleForFree(?bool $isAccessibleForFree): void
	{
		$this->isAccessibleForFree = $isAccessibleForFree;
	}

	public function getIsAccessibleForFree(): ?bool
	{
		return $this->isAccessibleForFree;
	}

	public function setEvent(Event $event): void
	{
		$this->event = $event;
	}

	public function getEvent(): Event
	{
		return $this->event;
	}

	public function setTourBookingPage(?string $tourBookingPage): void
	{
		$this->tourBookingPage = $tourBookingPage;
	}

	public function getTourBookingPage(): ?string
	{
		return $this->tourBookingPage;
	}

	public function setAmenityFeature(LocationFeatureSpecification $amenityFeature): void
	{
		$this->amenityFeature = $amenityFeature;
	}

	public function getAmenityFeature(): LocationFeatureSpecification
	{
		return $this->amenityFeature;
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

	public function setContainsPlace(?Place $containsPlace): void
	{
		$this->containsPlace = $containsPlace;
	}

	public function getContainsPlace(): ?Place
	{
		return $this->containsPlace;
	}
}

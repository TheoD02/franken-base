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
 * A trip or journey. An itinerary of visits to one or more places.
 *
 * @see https://schema.org/Trip
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'trip' => Trip::class,
	'touristTrip' => TouristTrip::class,
	'busTrip' => BusTrip::class,
	'boatTrip' => BoatTrip::class,
	'trainTrip' => TrainTrip::class,
	'flight' => Flight::class,
])]
class Trip extends Intangible
{
	/**
	 * The service provider, service operator, or service performer; the goods producer. Another party (a seller) may offer those services or goods on behalf of the provider. A provider may also serve as the seller.
	 *
	 * @see https://schema.org/provider
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ApiProperty(types: ['https://schema.org/provider'])]
	private ?Person $provider = null;

	/**
	 * @var Collection<Place>|null Destination(s) ( \[\[Place\]\] ) that make up a trip. For a trip where destination order is important use \[\[ItemList\]\] to specify that order (see examples).
	 * @see https://schema.org/itinerary
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinTable(name: 'trip_place_itinerary')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/itinerary'])]
	private ?Collection $itinerary = null;

	/**
	 * @var Collection<Place>|null The location of origin of the trip, prior to any destination(s).
	 * @see https://schema.org/tripOrigin
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinTable(name: 'trip_place_trip_origin')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/tripOrigin'])]
	private ?Collection $tripOrigin = null;

	/**
	 * The expected arrival time.
	 *
	 * @see https://schema.org/arrivalTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/arrivalTime'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $arrivalTime = null;

	/**
	 * The expected departure time.
	 *
	 * @see https://schema.org/departureTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
	#[ApiProperty(types: ['https://schema.org/departureTime'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $departureTime = null;

	/**
	 * Identifies that this \[\[Trip\]\] is a subTrip of another Trip. For example Day 1, Day 2, etc. of a multi-day trip.
	 *
	 * @see https://schema.org/partOfTrip
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Trip')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/partOfTrip'])]
	#[Assert\NotNull]
	private Trip $partOfTrip;

	/**
	 * Identifies a \[\[Trip\]\] that is a subTrip of this Trip. For example Day 1, Day 2, etc. of a multi-day trip.
	 *
	 * @see https://schema.org/subTrip
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Trip')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/subTrip'])]
	#[Assert\NotNull]
	private Trip $subTrip;

	/**
	 * @var Collection<Demand>|null An offer to provide this item—for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use \[\[businessFunction\]\] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a \[\[Demand\]\]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
	 * @see https://schema.org/offers
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Demand')]
	#[ORM\JoinTable(name: 'trip_demand_offers')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/offers'])]
	private ?Collection $offers = null;

	function __construct()
	{
		$this->itinerary = new ArrayCollection();
		$this->tripOrigin = new ArrayCollection();
		$this->offers = new ArrayCollection();
	}

	public function setProvider(?Person $provider): void
	{
		$this->provider = $provider;
	}

	public function getProvider(): ?Person
	{
		return $this->provider;
	}

	public function addItinerary(Place $itinerary): void
	{
		$this->itinerary[] = $itinerary;
	}

	public function removeItinerary(Place $itinerary): void
	{
		$this->itinerary->removeElement($itinerary);
	}

	/**
	 * @return Collection<Place>|null
	 */
	public function getItinerary(): Collection
	{
		return $this->itinerary;
	}

	public function addTripOrigin(Place $tripOrigin): void
	{
		$this->tripOrigin[] = $tripOrigin;
	}

	public function removeTripOrigin(Place $tripOrigin): void
	{
		$this->tripOrigin->removeElement($tripOrigin);
	}

	/**
	 * @return Collection<Place>|null
	 */
	public function getTripOrigin(): Collection
	{
		return $this->tripOrigin;
	}

	public function setArrivalTime(?\DateTimeInterface $arrivalTime): void
	{
		$this->arrivalTime = $arrivalTime;
	}

	public function getArrivalTime(): ?\DateTimeInterface
	{
		return $this->arrivalTime;
	}

	public function setDepartureTime(?\DateTimeInterface $departureTime): void
	{
		$this->departureTime = $departureTime;
	}

	public function getDepartureTime(): ?\DateTimeInterface
	{
		return $this->departureTime;
	}

	public function setPartOfTrip(Trip $partOfTrip): void
	{
		$this->partOfTrip = $partOfTrip;
	}

	public function getPartOfTrip(): Trip
	{
		return $this->partOfTrip;
	}

	public function setSubTrip(Trip $subTrip): void
	{
		$this->subTrip = $subTrip;
	}

	public function getSubTrip(): Trip
	{
		return $this->subTrip;
	}

	public function addOffer(Demand $offer): void
	{
		$this->offers[] = $offer;
	}

	public function removeOffer(Demand $offer): void
	{
		$this->offers->removeElement($offer);
	}

	/**
	 * @return Collection<Demand>|null
	 */
	public function getOffers(): Collection
	{
		return $this->offers;
	}
}

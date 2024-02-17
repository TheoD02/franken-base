<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An accommodation is a place that can accommodate human beings, e.g. a hotel room, a camping pitch, or a meeting room. Many accommodations are for overnight stays, but this is not a mandatory requirement. For more specific types of accommodations not defined in schema.org, one can use \[\[additionalType\]\] with external vocabularies.
 *
 * See also the [dedicated document on the use of schema.org for marking up hotels and other forms of accommodations](/docs/hotels.html).
 *
 * @see https://schema.org/Accommodation
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'accommodation' => Accommodation::class,
    'campingPitch' => CampingPitch::class,
    'apartment' => Apartment::class,
    'suite' => Suite::class,
    'meetingRoom' => MeetingRoom::class,
    'hotelRoom' => HotelRoom::class,
    'singleFamilyResidence' => SingleFamilyResidence::class,
])]
class Accommodation extends Place
{
    /**
     * The total integer number of bedrooms in a some \[\[Accommodation\]\], \[\[ApartmentComplex\]\] or \[\[FloorPlan\]\].
     *
     * @see https://schema.org/numberOfBedrooms
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/numberOfBedrooms'])]
    private ?string $numberOfBedrooms = null;

    /**
     * The floor level for an \[\[Accommodation\]\] in a multi-storey building. Since counting systems \[vary internationally\](https://en.wikipedia.org/wiki/Storey#Consecutive\_number\_floor\_designations), the local system should be used where possible.
     *
     * @see https://schema.org/floorLevel
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/floorLevel'])]
    private ?string $floorLevel = null;

    /**
     * Indications regarding the permitted usage of the accommodation.
     *
     * @see https://schema.org/permittedUsage
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/permittedUsage'])]
    private ?string $permittedUsage = null;

    /**
     * The type of bed or beds included in the accommodation. For the single case of just one bed of a certain type, you use bed directly with a text. If you want to indicate the quantity of a certain kind of bed, use an instance of BedDetails. For more detailed information, use the amenityFeature property.
     *
     * @see https://schema.org/bed
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/bed'])]
    private ?string $bed = null;

    /**
     * Number of full bathrooms - The total number of full and ¾ bathrooms in an \[\[Accommodation\]\]. This corresponds to the \[BathroomsFull field in RESO\](https://ddwiki.reso.org/display/DDW17/BathroomsFull+Field).
     *
     * @see https://schema.org/numberOfFullBathrooms
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/numberOfFullBathrooms'])]
    private ?string $numberOfFullBathrooms = null;

    /**
     * The year an \[\[Accommodation\]\] was constructed. This corresponds to the \[YearBuilt field in RESO\](https://ddwiki.reso.org/display/DDW17/YearBuilt+Field).
     *
     * @see https://schema.org/yearBuilt
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/yearBuilt'])]
    private ?string $yearBuilt = null;

    /**
     * @var Collection<Number>|null The number of rooms (excluding bathrooms and closets) of the accommodation or lodging business. Typical unit code(s): ROM for room or C62 for no unit. The type of room can be put in the unitText property of the QuantitativeValue.
     *
     * @see https://schema.org/numberOfRooms
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Number')]
    #[ORM\JoinTable(name: 'accommodation_number_number_of_rooms')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/numberOfRooms'])]
    private ?Collection $numberOfRooms = null;

    /**
     * Length of the lease for some \[\[Accommodation\]\], either particular to some \[\[Offer\]\] or in some cases intrinsic to the property.
     *
     * @see https://schema.org/leaseLength
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/leaseLength'])]
    #[Assert\NotNull]
    private QuantitativeValue $leaseLength;

    /**
     * Number of partial bathrooms - The total number of half and ¼ bathrooms in an \[\[Accommodation\]\]. This corresponds to the \[BathroomsPartial field in RESO\](https://ddwiki.reso.org/display/DDW17/BathroomsPartial+Field).
     *
     * @see https://schema.org/numberOfPartialBathrooms
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/numberOfPartialBathrooms'])]
    private ?string $numberOfPartialBathrooms = null;

    /**
     * Category of an \[\[Accommodation\]\], following real estate conventions, e.g. RESO (see \[PropertySubType\](https://ddwiki.reso.org/display/DDW17/PropertySubType+Field), and \[PropertyType\](https://ddwiki.reso.org/display/DDW17/PropertyType+Field) fields for suggested values).
     *
     * @see https://schema.org/accommodationCategory
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/accommodationCategory'])]
    private ?string $accommodationCategory = null;

    /**
     * A floorplan of some \[\[Accommodation\]\].
     *
     * @see https://schema.org/accommodationFloorPlan
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\FloorPlan')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/accommodationFloorPlan'])]
    #[Assert\NotNull]
    private FloorPlan $accommodationFloorPlan;

    /**
     * @var Collection<QuantitativeValue>|null The allowed total occupancy for the accommodation in persons (including infants etc). For individual accommodations, this is not necessarily the legal maximum but defines the permitted usage as per the contractual agreement (e.g. a double room used by a single person). Typical unit code(s): C62 for person.
     *
     * @see https://schema.org/occupancy
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'accommodation_quantitative_value_occupancy')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/occupancy'])]
    private ?Collection $occupancy = null;

    /**
     * Indicates whether pets are allowed to enter the accommodation or lodging business. More detailed information can be put in a text value.
     *
     * @see https://schema.org/petsAllowed
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/petsAllowed'])]
    private ?bool $petsAllowed = null;

    /**
     * @var Collection<QuantitativeValue>|null The size of the accommodation, e.g. in square meter or squarefoot. Typical unit code(s): MTK for square meter, FTK for square foot, or YDK for square yard.
     *
     * @see https://schema.org/floorSize
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'accommodation_quantitative_value_floor_size')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/floorSize'])]
    private ?Collection $floorSize = null;

    /**
     * The total integer number of bathrooms in some \[\[Accommodation\]\], following real estate conventions as \[documented in RESO\](https://ddwiki.reso.org/display/DDW17/BathroomsTotalInteger+Field): "The simple sum of the number of bathrooms. For example for a property with two Full Bathrooms and one Half Bathroom, the Bathrooms Total Integer will be 3.". See also \[\[numberOfRooms\]\].
     *
     * @see https://schema.org/numberOfBathroomsTotal
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/numberOfBathroomsTotal'])]
    private ?int $numberOfBathroomsTotal = null;

    public function __construct()
    {
        parent::__construct();
        $this->numberOfRooms = new ArrayCollection();
        $this->occupancy = new ArrayCollection();
        $this->floorSize = new ArrayCollection();
    }

    public function setNumberOfBedrooms(?string $numberOfBedrooms): void
    {
        $this->numberOfBedrooms = $numberOfBedrooms;
    }

    public function getNumberOfBedrooms(): ?string
    {
        return $this->numberOfBedrooms;
    }

    public function setFloorLevel(?string $floorLevel): void
    {
        $this->floorLevel = $floorLevel;
    }

    public function getFloorLevel(): ?string
    {
        return $this->floorLevel;
    }

    public function setPermittedUsage(?string $permittedUsage): void
    {
        $this->permittedUsage = $permittedUsage;
    }

    public function getPermittedUsage(): ?string
    {
        return $this->permittedUsage;
    }

    public function setBed(?string $bed): void
    {
        $this->bed = $bed;
    }

    public function getBed(): ?string
    {
        return $this->bed;
    }

    public function setNumberOfFullBathrooms(?string $numberOfFullBathrooms): void
    {
        $this->numberOfFullBathrooms = $numberOfFullBathrooms;
    }

    public function getNumberOfFullBathrooms(): ?string
    {
        return $this->numberOfFullBathrooms;
    }

    public function setYearBuilt(?string $yearBuilt): void
    {
        $this->yearBuilt = $yearBuilt;
    }

    public function getYearBuilt(): ?string
    {
        return $this->yearBuilt;
    }

    public function addNumberOfRoom(string $numberOfRoom): void
    {
        $this->numberOfRooms[] = $numberOfRoom;
    }

    public function removeNumberOfRoom(string $numberOfRoom): void
    {
        $this->numberOfRooms->removeElement($numberOfRoom);
    }

    /**
     * @return Collection<Number>|null
     */
    public function getNumberOfRooms(): Collection
    {
        return $this->numberOfRooms;
    }

    public function setLeaseLength(QuantitativeValue $leaseLength): void
    {
        $this->leaseLength = $leaseLength;
    }

    public function getLeaseLength(): QuantitativeValue
    {
        return $this->leaseLength;
    }

    public function setNumberOfPartialBathrooms(?string $numberOfPartialBathrooms): void
    {
        $this->numberOfPartialBathrooms = $numberOfPartialBathrooms;
    }

    public function getNumberOfPartialBathrooms(): ?string
    {
        return $this->numberOfPartialBathrooms;
    }

    public function setAccommodationCategory(?string $accommodationCategory): void
    {
        $this->accommodationCategory = $accommodationCategory;
    }

    public function getAccommodationCategory(): ?string
    {
        return $this->accommodationCategory;
    }

    public function setAccommodationFloorPlan(FloorPlan $accommodationFloorPlan): void
    {
        $this->accommodationFloorPlan = $accommodationFloorPlan;
    }

    public function getAccommodationFloorPlan(): FloorPlan
    {
        return $this->accommodationFloorPlan;
    }

    public function addOccupancy(QuantitativeValue $occupancy): void
    {
        $this->occupancy[] = $occupancy;
    }

    public function removeOccupancy(QuantitativeValue $occupancy): void
    {
        $this->occupancy->removeElement($occupancy);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getOccupancy(): Collection
    {
        return $this->occupancy;
    }

    public function setPetsAllowed(?bool $petsAllowed): void
    {
        $this->petsAllowed = $petsAllowed;
    }

    public function getPetsAllowed(): ?bool
    {
        return $this->petsAllowed;
    }

    public function addFloorSize(QuantitativeValue $floorSize): void
    {
        $this->floorSize[] = $floorSize;
    }

    public function removeFloorSize(QuantitativeValue $floorSize): void
    {
        $this->floorSize->removeElement($floorSize);
    }

    /**
     * @return Collection<QuantitativeValue>|null
     */
    public function getFloorSize(): Collection
    {
        return $this->floorSize;
    }

    public function setNumberOfBathroomsTotal(?int $numberOfBathroomsTotal): void
    {
        $this->numberOfBathroomsTotal = $numberOfBathroomsTotal;
    }

    public function getNumberOfBathroomsTotal(): ?int
    {
        return $this->numberOfBathroomsTotal;
    }
}

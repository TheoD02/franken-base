<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A FloorPlan is an explicit representation of a collection of similar accommodations, allowing the provision of common information (room counts, sizes, layout diagrams) and offers for rental or sale. In typical use, some \[\[ApartmentComplex\]\] has an \[\[accommodationFloorPlan\]\] which is a \[\[FloorPlan\]\]. A FloorPlan is always in the context of a particular place, either a larger \[\[ApartmentComplex\]\] or a single \[\[Apartment\]\]. The visual/spatial aspects of a floor plan (i.e. room layout, \[see wikipedia\](https://en.wikipedia.org/wiki/Floor\_plan)) can be indicated using \[\[image\]\].
 *
 * @see https://schema.org/FloorPlan
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/FloorPlan'])]
class FloorPlan extends Intangible
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
     * Indicates the number of available accommodation units in an \[\[ApartmentComplex\]\], or the number of accommodation units for a specific \[\[FloorPlan\]\] (within its specific \[\[ApartmentComplex\]\]). See also \[\[numberOfAccommodationUnits\]\].
     *
     * @see https://schema.org/numberOfAvailableAccommodationUnits
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/numberOfAvailableAccommodationUnits'])]
    #[Assert\NotNull]
    private QuantitativeValue $numberOfAvailableAccommodationUnits;

    /**
     * Indicates the total (available plus unavailable) number of accommodation units in an \[\[ApartmentComplex\]\], or the number of accommodation units for a specific \[\[FloorPlan\]\] (within its specific \[\[ApartmentComplex\]\]). See also \[\[numberOfAvailableAccommodationUnits\]\].
     *
     * @see https://schema.org/numberOfAccommodationUnits
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/numberOfAccommodationUnits'])]
    #[Assert\NotNull]
    private QuantitativeValue $numberOfAccommodationUnits;

    /**
     * Number of full bathrooms - The total number of full and ¾ bathrooms in an \[\[Accommodation\]\]. This corresponds to the \[BathroomsFull field in RESO\](https://ddwiki.reso.org/display/DDW17/BathroomsFull+Field).
     *
     * @see https://schema.org/numberOfFullBathrooms
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/numberOfFullBathrooms'])]
    private ?string $numberOfFullBathrooms = null;

    /**
     * @var Collection<Number>|null The number of rooms (excluding bathrooms and closets) of the accommodation or lodging business. Typical unit code(s): ROM for room or C62 for no unit. The type of room can be put in the unitText property of the QuantitativeValue.
     *
     * @see https://schema.org/numberOfRooms
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Number')]
    #[ORM\JoinTable(name: 'floor_plan_number_number_of_rooms')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/numberOfRooms'])]
    private ?Collection $numberOfRooms = null;

    /**
     * Number of partial bathrooms - The total number of half and ¼ bathrooms in an \[\[Accommodation\]\]. This corresponds to the \[BathroomsPartial field in RESO\](https://ddwiki.reso.org/display/DDW17/BathroomsPartial+Field).
     *
     * @see https://schema.org/numberOfPartialBathrooms
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/numberOfPartialBathrooms'])]
    private ?string $numberOfPartialBathrooms = null;

    /**
     * A schematic image showing the floorplan layout.
     *
     * @see https://schema.org/layoutImage
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ImageObject')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/layoutImage'])]
    #[Assert\NotNull]
    private ImageObject $layoutImage;

    /**
     * Indicates some accommodation that this floor plan describes.
     *
     * @see https://schema.org/isPlanForApartment
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Accommodation')]
    #[ApiProperty(types: ['https://schema.org/isPlanForApartment'])]
    private ?Accommodation $isPlanForApartment = null;

    /**
     * Indicates whether pets are allowed to enter the accommodation or lodging business. More detailed information can be put in a text value.
     *
     * @see https://schema.org/petsAllowed
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/petsAllowed'])]
    private ?bool $petsAllowed = null;

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
     * @var Collection<QuantitativeValue>|null The size of the accommodation, e.g. in square meter or squarefoot. Typical unit code(s): MTK for square meter, FTK for square foot, or YDK for square yard.
     *
     * @see https://schema.org/floorSize
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinTable(name: 'floor_plan_quantitative_value_floor_size')]
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
        $this->numberOfRooms = new ArrayCollection();
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

    public function setNumberOfAvailableAccommodationUnits(QuantitativeValue $numberOfAvailableAccommodationUnits): void
    {
        $this->numberOfAvailableAccommodationUnits = $numberOfAvailableAccommodationUnits;
    }

    public function getNumberOfAvailableAccommodationUnits(): QuantitativeValue
    {
        return $this->numberOfAvailableAccommodationUnits;
    }

    public function setNumberOfAccommodationUnits(QuantitativeValue $numberOfAccommodationUnits): void
    {
        $this->numberOfAccommodationUnits = $numberOfAccommodationUnits;
    }

    public function getNumberOfAccommodationUnits(): QuantitativeValue
    {
        return $this->numberOfAccommodationUnits;
    }

    public function setNumberOfFullBathrooms(?string $numberOfFullBathrooms): void
    {
        $this->numberOfFullBathrooms = $numberOfFullBathrooms;
    }

    public function getNumberOfFullBathrooms(): ?string
    {
        return $this->numberOfFullBathrooms;
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

    public function setNumberOfPartialBathrooms(?string $numberOfPartialBathrooms): void
    {
        $this->numberOfPartialBathrooms = $numberOfPartialBathrooms;
    }

    public function getNumberOfPartialBathrooms(): ?string
    {
        return $this->numberOfPartialBathrooms;
    }

    public function setLayoutImage(ImageObject $layoutImage): void
    {
        $this->layoutImage = $layoutImage;
    }

    public function getLayoutImage(): ImageObject
    {
        return $this->layoutImage;
    }

    public function setIsPlanForApartment(?Accommodation $isPlanForApartment): void
    {
        $this->isPlanForApartment = $isPlanForApartment;
    }

    public function getIsPlanForApartment(): ?Accommodation
    {
        return $this->isPlanForApartment;
    }

    public function setPetsAllowed(?bool $petsAllowed): void
    {
        $this->petsAllowed = $petsAllowed;
    }

    public function getPetsAllowed(): ?bool
    {
        return $this->petsAllowed;
    }

    public function setAmenityFeature(LocationFeatureSpecification $amenityFeature): void
    {
        $this->amenityFeature = $amenityFeature;
    }

    public function getAmenityFeature(): LocationFeatureSpecification
    {
        return $this->amenityFeature;
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

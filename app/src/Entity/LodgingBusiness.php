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
 * A lodging business, such as a motel, hotel, or inn.
 *
 * @see https://schema.org/LodgingBusiness
 */
#[ORM\MappedSuperclass]
abstract class LodgingBusiness extends LocalBusiness
{
    /**
     * A language someone may use with or at the item, service or place. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[inLanguage\]\].
     *
     * @see https://schema.org/availableLanguage
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Language')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/availableLanguage'])]
    #[Assert\NotNull]
    private Language $availableLanguage;

    /**
     * @var Collection<Number>|null The number of rooms (excluding bathrooms and closets) of the accommodation or lodging business. Typical unit code(s): ROM for room or C62 for no unit. The type of room can be put in the unitText property of the QuantitativeValue.
     *
     * @see https://schema.org/numberOfRooms
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Number')]
    #[ORM\JoinTable(name: 'lodging_business_number_number_of_rooms')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/numberOfRooms'])]
    private ?Collection $numberOfRooms = null;

    /**
     * The latest someone may check out of a lodging establishment.
     *
     * @see https://schema.org/checkoutTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
    #[ApiProperty(types: ['https://schema.org/checkoutTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $checkoutTime = null;

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
     * An intended audience, i.e. a group for whom something was created.
     *
     * @see https://schema.org/audience
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Audience')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/audience'])]
    #[Assert\NotNull]
    private Audience $audience;

    /**
     * An official rating for a lodging business or food establishment, e.g. from national associations or standards bodies. Use the author property to indicate the rating organization, e.g. as an Organization with name such as (e.g. HOTREC, DEHOGA, WHR, or Hotelstars).
     *
     * @see https://schema.org/starRating
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Rating')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/starRating'])]
    #[Assert\NotNull]
    private Rating $starRating;

    /**
     * The earliest someone may check into a lodging establishment.
     *
     * @see https://schema.org/checkinTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/checkinTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $checkinTime = null;

    public function __construct()
    {
        $this->numberOfRooms = new ArrayCollection();
    }

    public function setAvailableLanguage(Language $availableLanguage): void
    {
        $this->availableLanguage = $availableLanguage;
    }

    public function getAvailableLanguage(): Language
    {
        return $this->availableLanguage;
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

    public function setCheckoutTime(?\DateTimeInterface $checkoutTime): void
    {
        $this->checkoutTime = $checkoutTime;
    }

    public function getCheckoutTime(): ?\DateTimeInterface
    {
        return $this->checkoutTime;
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

    public function setAudience(Audience $audience): void
    {
        $this->audience = $audience;
    }

    public function getAudience(): Audience
    {
        return $this->audience;
    }

    public function setStarRating(Rating $starRating): void
    {
        $this->starRating = $starRating;
    }

    public function getStarRating(): Rating
    {
        return $this->starRating;
    }

    public function setCheckinTime(?\DateTimeInterface $checkinTime): void
    {
        $this->checkinTime = $checkinTime;
    }

    public function getCheckinTime(): ?\DateTimeInterface
    {
        return $this->checkinTime;
    }
}

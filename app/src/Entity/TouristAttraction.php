<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A tourist attraction. In principle any Thing can be a \[\[TouristAttraction\]\], from a \[\[Mountain\]\] and \[\[LandmarksOrHistoricalBuildings\]\] to a \[\[LocalBusiness\]\]. This Type can be used on its own to describe a general \[\[TouristAttraction\]\], or be used as an \[\[additionalType\]\] to add tourist attraction properties to any other type. (See examples below).
 *
 * @see https://schema.org/TouristAttraction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TouristAttraction'])]
class TouristAttraction extends Place
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
     * @var Collection<Audience>|null Attraction suitable for type(s) of tourist. E.g. children, visitors from a particular country, etc.
     *
     * @see https://schema.org/touristType
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Audience')]
    #[ORM\JoinTable(name: 'tourist_attraction_audience_tourist_type')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/touristType'])]
    private ?Collection $touristType = null;

    public function __construct()
    {
        parent::__construct();
        $this->touristType = new ArrayCollection();
    }

    public function setAvailableLanguage(Language $availableLanguage): void
    {
        $this->availableLanguage = $availableLanguage;
    }

    public function getAvailableLanguage(): Language
    {
        return $this->availableLanguage;
    }

    public function addTouristType(Audience $touristType): void
    {
        $this->touristType[] = $touristType;
    }

    public function removeTouristType(Audience $touristType): void
    {
        $this->touristType->removeElement($touristType);
    }

    /**
     * @return Collection<Audience>|null
     */
    public function getTouristType(): Collection
    {
        return $this->touristType;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\ContactPointOption;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A contact point—for example, a Customer Complaints department.
 *
 * @see https://schema.org/ContactPoint
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['contactPoint' => ContactPoint::class, 'postalAddress' => PostalAddress::class])]
class ContactPoint extends StructuredValue
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
     * An option available on this contact point (e.g. a toll-free number or support for hearing-impaired callers).
     *
     * @see https://schema.org/contactOption
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/contactOption'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [ContactPointOption::class, 'toArray'])]
    private string $contactOption;

    /**
     * The telephone number.
     *
     * @see https://schema.org/telephone
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/telephone'])]
    private ?string $telephone = null;

    /**
     * Email address.
     *
     * @see https://schema.org/email
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/email'])]
    #[Assert\Email]
    private ?string $email = null;

    /**
     * The fax number.
     *
     * @see https://schema.org/faxNumber
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/faxNumber'])]
    private ?string $faxNumber = null;

    /**
     * The geographic area where a service or offered item is provided.
     *
     * @see https://schema.org/areaServed
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/areaServed'])]
    private ?string $areaServed = null;

    /**
     * The product or service this support contact point is related to (such as product support for a particular product line). This can be a specific product or product line (e.g. "iPhone") or a general category of products or services (e.g. "smartphones").
     *
     * @see https://schema.org/productSupported
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/productSupported'])]
    private ?string $productSupported = null;

    /**
     * The hours during which this service or contact is available.
     *
     * @see https://schema.org/hoursAvailable
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\OpeningHoursSpecification')]
    #[ApiProperty(types: ['https://schema.org/hoursAvailable'])]
    private ?OpeningHoursSpecification $hoursAvailable = null;

    /**
     * A person or organization can have different contact points, for different purposes. For example, a sales contact point, a PR contact point and so on. This property is used to specify the kind of contact point.
     *
     * @see https://schema.org/contactType
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/contactType'])]
    private ?string $contactType = null;

    public function setAvailableLanguage(Language $availableLanguage): void
    {
        $this->availableLanguage = $availableLanguage;
    }

    public function getAvailableLanguage(): Language
    {
        return $this->availableLanguage;
    }

    public function setContactOption(string $contactOption): void
    {
        $this->contactOption = $contactOption;
    }

    public function getContactOption(): string
    {
        return $this->contactOption;
    }

    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setFaxNumber(?string $faxNumber): void
    {
        $this->faxNumber = $faxNumber;
    }

    public function getFaxNumber(): ?string
    {
        return $this->faxNumber;
    }

    public function setAreaServed(?string $areaServed): void
    {
        $this->areaServed = $areaServed;
    }

    public function getAreaServed(): ?string
    {
        return $this->areaServed;
    }

    public function setProductSupported(?string $productSupported): void
    {
        $this->productSupported = $productSupported;
    }

    public function getProductSupported(): ?string
    {
        return $this->productSupported;
    }

    public function setHoursAvailable(?OpeningHoursSpecification $hoursAvailable): void
    {
        $this->hoursAvailable = $hoursAvailable;
    }

    public function getHoursAvailable(): ?OpeningHoursSpecification
    {
        return $this->hoursAvailable;
    }

    public function setContactType(?string $contactType): void
    {
        $this->contactType = $contactType;
    }

    public function getContactType(): ?string
    {
        return $this->contactType;
    }
}

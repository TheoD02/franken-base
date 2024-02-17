<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\MerchantReturnEnumeration;
use App\Enum\OfferItemCondition;
use App\Enum\RefundTypeEnumeration;
use App\Enum\ReturnFeesEnumeration;
use App\Enum\ReturnLabelSourceEnumeration;
use App\Enum\ReturnMethodEnumeration;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A MerchantReturnPolicy provides information about product return policies associated with an \[\[Organization\]\], \[\[Product\]\], or \[\[Offer\]\].
 *
 * @see https://schema.org/MerchantReturnPolicy
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MerchantReturnPolicy'])]
class MerchantReturnPolicy extends Intangible
{
    /**
     * Amount of shipping costs for product returns (for any reason). Applicable when property \[\[returnFees\]\] equals \[\[ReturnShippingFees\]\].
     *
     * @see https://schema.org/returnShippingFeesAmount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/returnShippingFeesAmount'])]
    #[Assert\NotNull]
    private MonetaryAmount $returnShippingFeesAmount;

    /**
     * Specifies a Web page or service by URL, for product returns.
     *
     * @see https://schema.org/merchantReturnLink
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/merchantReturnLink'])]
    #[Assert\Url]
    private ?string $merchantReturnLink = null;

    /**
     * Specifies an applicable return policy (from an enumeration).
     *
     * @see https://schema.org/returnPolicyCategory
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/returnPolicyCategory'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [MerchantReturnEnumeration::class, 'toArray'])]
    private string $returnPolicyCategory;

    /**
     * Specifies either a fixed return date or the number of days (from the delivery date) that a product can be returned. Used when the \[\[returnPolicyCategory\]\] property is specified as \[\[MerchantReturnFiniteReturnWindow\]\].
     *
     * @see https://schema.org/merchantReturnDays
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Integer')]
    #[ApiProperty(types: ['https://schema.org/merchantReturnDays'])]
    private ?int $merchantReturnDays = null;

    /**
     * The country where the product has to be sent to for returns, for example "Ireland" using the \[\[name\]\] property of \[\[Country\]\]. You can also provide the two-letter \[ISO 3166-1 alpha-2 country code\](http://en.wikipedia.org/wiki/ISO\_3166-1). Note that this can be different from the country where the product was originally shipped from or sent to.
     *
     * @see https://schema.org/returnPolicyCountry
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/returnPolicyCountry'])]
    private ?string $returnPolicyCountry = null;

    /**
     * Amount of shipping costs for defect product returns. Applicable when property \[\[itemDefectReturnFees\]\] equals \[\[ReturnShippingFees\]\].
     *
     * @see https://schema.org/itemDefectReturnShippingFeesAmount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/itemDefectReturnShippingFeesAmount'])]
    #[Assert\NotNull]
    private MonetaryAmount $itemDefectReturnShippingFeesAmount;

    /**
     * A country where a particular merchant return policy applies to, for example the two-letter ISO 3166-1 alpha-2 country code.
     *
     * @see https://schema.org/applicableCountry
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/applicableCountry'])]
    private ?string $applicableCountry = null;

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
     * The method (from an enumeration) by which the customer obtains a return shipping label for a product returned due to customer remorse.
     *
     * @see https://schema.org/customerRemorseReturnLabelSource
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/customerRemorseReturnLabelSource'])]
    #[Assert\Choice(callback: [ReturnLabelSourceEnumeration::class, 'toArray'])]
    private ?string $customerRemorseReturnLabelSource = null;

    /**
     * A predefined value from OfferItemCondition specifying the condition of the product or service, or the products or services included in the offer. Also used for product return policies to specify the condition of products accepted for returns.
     *
     * @see https://schema.org/itemCondition
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/itemCondition'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [OfferItemCondition::class, 'toArray'])]
    private string $itemCondition;

    /**
     * The amount of shipping costs if a product is returned due to customer remorse. Applicable when property \[\[customerRemorseReturnFees\]\] equals \[\[ReturnShippingFees\]\].
     *
     * @see https://schema.org/customerRemorseReturnShippingFeesAmount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/customerRemorseReturnShippingFeesAmount'])]
    private ?MonetaryAmount $customerRemorseReturnShippingFeesAmount = null;

    /**
     * Seasonal override of a return policy.
     *
     * @see https://schema.org/returnPolicySeasonalOverride
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MerchantReturnPolicySeasonalOverride')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/returnPolicySeasonalOverride'])]
    #[Assert\NotNull]
    private MerchantReturnPolicySeasonalOverride $returnPolicySeasonalOverride;

    /**
     * The type of return method offered, specified from an enumeration.
     *
     * @see https://schema.org/returnMethod
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/returnMethod'])]
    #[Assert\Choice(callback: [ReturnMethodEnumeration::class, 'toArray'])]
    private ?string $returnMethod = null;

    /**
     * A refund type, from an enumerated list.
     *
     * @see https://schema.org/refundType
     */
    #[ORM\Column]
    #[ApiProperty(types: ['https://schema.org/refundType'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [RefundTypeEnumeration::class, 'toArray'])]
    private string $refundType;

    /**
     * The method (from an enumeration) by which the customer obtains a return shipping label for a defect product.
     *
     * @see https://schema.org/itemDefectReturnLabelSource
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/itemDefectReturnLabelSource'])]
    #[Assert\Choice(callback: [ReturnLabelSourceEnumeration::class, 'toArray'])]
    private ?string $itemDefectReturnLabelSource = null;

    /**
     * The type of return fees for returns of defect products.
     *
     * @see https://schema.org/itemDefectReturnFees
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/itemDefectReturnFees'])]
    #[Assert\Choice(callback: [ReturnFeesEnumeration::class, 'toArray'])]
    private ?string $itemDefectReturnFees = null;

    /**
     * The type of return fees if the product is returned due to customer remorse.
     *
     * @see https://schema.org/customerRemorseReturnFees
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/customerRemorseReturnFees'])]
    #[Assert\Choice(callback: [ReturnFeesEnumeration::class, 'toArray'])]
    private ?string $customerRemorseReturnFees = null;

    /**
     * Use \[\[MonetaryAmount\]\] to specify a fixed restocking fee for product returns, or use \[\[Number\]\] to specify a percentage of the product price paid by the customer.
     *
     * @see https://schema.org/restockingFee
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/restockingFee'])]
    #[Assert\NotNull]
    private MonetaryAmount $restockingFee;

    /**
     * The method (from an enumeration) by which the customer obtains a return shipping label for a product returned for any reason.
     *
     * @see https://schema.org/returnLabelSource
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/returnLabelSource'])]
    #[Assert\Choice(callback: [ReturnLabelSourceEnumeration::class, 'toArray'])]
    private ?string $returnLabelSource = null;

    /**
     * The type of return fees for purchased products (for any return reason).
     *
     * @see https://schema.org/returnFees
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/returnFees'])]
    #[Assert\Choice(callback: [ReturnFeesEnumeration::class, 'toArray'])]
    private ?string $returnFees = null;

    /**
     * Are in-store returns offered? (For more advanced return methods use the \[\[returnMethod\]\] property.).
     *
     * @see https://schema.org/inStoreReturnsOffered
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/inStoreReturnsOffered'])]
    private ?bool $inStoreReturnsOffered = null;

    public function setReturnShippingFeesAmount(MonetaryAmount $returnShippingFeesAmount): void
    {
        $this->returnShippingFeesAmount = $returnShippingFeesAmount;
    }

    public function getReturnShippingFeesAmount(): MonetaryAmount
    {
        return $this->returnShippingFeesAmount;
    }

    public function setMerchantReturnLink(?string $merchantReturnLink): void
    {
        $this->merchantReturnLink = $merchantReturnLink;
    }

    public function getMerchantReturnLink(): ?string
    {
        return $this->merchantReturnLink;
    }

    public function setReturnPolicyCategory(string $returnPolicyCategory): void
    {
        $this->returnPolicyCategory = $returnPolicyCategory;
    }

    public function getReturnPolicyCategory(): string
    {
        return $this->returnPolicyCategory;
    }

    public function setMerchantReturnDays(?int $merchantReturnDays): void
    {
        $this->merchantReturnDays = $merchantReturnDays;
    }

    public function getMerchantReturnDays(): ?int
    {
        return $this->merchantReturnDays;
    }

    public function setReturnPolicyCountry(?string $returnPolicyCountry): void
    {
        $this->returnPolicyCountry = $returnPolicyCountry;
    }

    public function getReturnPolicyCountry(): ?string
    {
        return $this->returnPolicyCountry;
    }

    public function setItemDefectReturnShippingFeesAmount(MonetaryAmount $itemDefectReturnShippingFeesAmount): void
    {
        $this->itemDefectReturnShippingFeesAmount = $itemDefectReturnShippingFeesAmount;
    }

    public function getItemDefectReturnShippingFeesAmount(): MonetaryAmount
    {
        return $this->itemDefectReturnShippingFeesAmount;
    }

    public function setApplicableCountry(?string $applicableCountry): void
    {
        $this->applicableCountry = $applicableCountry;
    }

    public function getApplicableCountry(): ?string
    {
        return $this->applicableCountry;
    }

    public function setAdditionalProperty(PropertyValue $additionalProperty): void
    {
        $this->additionalProperty = $additionalProperty;
    }

    public function getAdditionalProperty(): PropertyValue
    {
        return $this->additionalProperty;
    }

    public function setCustomerRemorseReturnLabelSource(?string $customerRemorseReturnLabelSource): void
    {
        $this->customerRemorseReturnLabelSource = $customerRemorseReturnLabelSource;
    }

    public function getCustomerRemorseReturnLabelSource(): ?string
    {
        return $this->customerRemorseReturnLabelSource;
    }

    public function setItemCondition(string $itemCondition): void
    {
        $this->itemCondition = $itemCondition;
    }

    public function getItemCondition(): string
    {
        return $this->itemCondition;
    }

    public function setCustomerRemorseReturnShippingFeesAmount(
        ?MonetaryAmount $customerRemorseReturnShippingFeesAmount,
    ): void {
        $this->customerRemorseReturnShippingFeesAmount = $customerRemorseReturnShippingFeesAmount;
    }

    public function getCustomerRemorseReturnShippingFeesAmount(): ?MonetaryAmount
    {
        return $this->customerRemorseReturnShippingFeesAmount;
    }

    public function setReturnPolicySeasonalOverride(
        MerchantReturnPolicySeasonalOverride $returnPolicySeasonalOverride,
    ): void {
        $this->returnPolicySeasonalOverride = $returnPolicySeasonalOverride;
    }

    public function getReturnPolicySeasonalOverride(): MerchantReturnPolicySeasonalOverride
    {
        return $this->returnPolicySeasonalOverride;
    }

    public function setReturnMethod(?string $returnMethod): void
    {
        $this->returnMethod = $returnMethod;
    }

    public function getReturnMethod(): ?string
    {
        return $this->returnMethod;
    }

    public function setRefundType(string $refundType): void
    {
        $this->refundType = $refundType;
    }

    public function getRefundType(): string
    {
        return $this->refundType;
    }

    public function setItemDefectReturnLabelSource(?string $itemDefectReturnLabelSource): void
    {
        $this->itemDefectReturnLabelSource = $itemDefectReturnLabelSource;
    }

    public function getItemDefectReturnLabelSource(): ?string
    {
        return $this->itemDefectReturnLabelSource;
    }

    public function setItemDefectReturnFees(?string $itemDefectReturnFees): void
    {
        $this->itemDefectReturnFees = $itemDefectReturnFees;
    }

    public function getItemDefectReturnFees(): ?string
    {
        return $this->itemDefectReturnFees;
    }

    public function setCustomerRemorseReturnFees(?string $customerRemorseReturnFees): void
    {
        $this->customerRemorseReturnFees = $customerRemorseReturnFees;
    }

    public function getCustomerRemorseReturnFees(): ?string
    {
        return $this->customerRemorseReturnFees;
    }

    public function setRestockingFee(MonetaryAmount $restockingFee): void
    {
        $this->restockingFee = $restockingFee;
    }

    public function getRestockingFee(): MonetaryAmount
    {
        return $this->restockingFee;
    }

    public function setReturnLabelSource(?string $returnLabelSource): void
    {
        $this->returnLabelSource = $returnLabelSource;
    }

    public function getReturnLabelSource(): ?string
    {
        return $this->returnLabelSource;
    }

    public function setReturnFees(?string $returnFees): void
    {
        $this->returnFees = $returnFees;
    }

    public function getReturnFees(): ?string
    {
        return $this->returnFees;
    }

    public function setInStoreReturnsOffered(?bool $inStoreReturnsOffered): void
    {
        $this->inStoreReturnsOffered = $inStoreReturnsOffered;
    }

    public function getInStoreReturnsOffered(): ?bool
    {
        return $this->inStoreReturnsOffered;
    }
}

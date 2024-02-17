<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\BusinessEntityType;
use App\Enum\BusinessFunction;
use App\Enum\DeliveryMethod;
use App\Enum\ItemAvailability;
use App\Enum\OfferItemCondition;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A demand entity represents the public, not necessarily binding, not necessarily exclusive, announcement by an organization or person to seek a certain type of goods or services. For describing demand using this type, the very same properties used for Offer apply.
 *
 * @see https://schema.org/Demand
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Demand'])]
class Demand extends Intangible
{
    /**
     * @var Collection<Text>|null The Stock Keeping Unit (SKU), i.e. a merchant-specific identifier for a product or service, or the product to which the offer refers.
     *
     * @see https://schema.org/sku
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'demand_text_sku')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/sku'])]
    private ?Collection $sku = null;

    /**
     * The transaction volume, in a monetary unit, for which the offer or price specification is valid, e.g. for indicating a minimal purchasing volume, to express free shipping above a certain order volume, or to limit the acceptance of credit cards to purchases to a certain minimal amount.
     *
     * @see https://schema.org/eligibleTransactionVolume
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
    #[ApiProperty(types: ['https://schema.org/eligibleTransactionVolume'])]
    private ?PriceSpecification $eligibleTransactionVolume = null;

    /**
     * @var string[] The business function (e.g. sell, lease, repair, dispose) of the offer or component of a bundle (TypeAndQuantityNode). The default is http://purl.org/goodrelations/v1#Sell.
     *
     * @see https://schema.org/businessFunction
     */
    #[ORM\Column(type: 'simple_array')]
    #[ApiProperty(types: ['https://schema.org/businessFunction'])]
    #[Assert\NotNull]
    #[Assert\Choice(callback: [BusinessFunction::class, 'toArray'], multiple: true)]
    private Collection $businessFunction;

    /**
     * The typical delay between the receipt of the order and the goods either leaving the warehouse or being prepared for pickup, in case the delivery method is on site pickup.
     *
     * @see https://schema.org/deliveryLeadTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/deliveryLeadTime'])]
    private ?QuantitativeValue $deliveryLeadTime = null;

    /**
     * @var Collection<PriceSpecification>|null one or more detailed price specifications, indicating the unit price and delivery or payment charges
     *
     * @see https://schema.org/priceSpecification
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\PriceSpecification')]
    #[ORM\JoinTable(name: 'demand_price_specification_price_specification')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/priceSpecification'])]
    private ?Collection $priceSpecification = null;

    /**
     * @var Collection<Text>|null The GTIN-8 code of the product, or the product to which the offer refers. This code is also known as EAN/UCC-8 or 8-digit EAN. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
     *
     * @see https://schema.org/gtin8
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'demand_text_gtin8')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/gtin8'])]
    private ?Collection $gtin8 = null;

    /**
     * A Global Trade Item Number (\[GTIN\](https://www.gs1.org/standards/id-keys/gtin)). GTINs identify trade items, including products and services, using numeric identification codes. The GS1 \[digital link specifications\](https://www.gs1.org/standards/Digital-Link/) express GTINs as URLs (URIs, IRIs, etc.). Details including regular expression examples can be found in, Section 6 of the GS1 URI Syntax specification; see also \[schema.org tracking issue\](https://github.com/schemaorg/schemaorg/issues/3156#issuecomment-1209522809) for schema.org-specific discussion. A correct \[\[gtin\]\] value should be a valid GTIN, which means that it should be an all-numeric string of either 8, 12, 13 or 14 digits, or a "GS1 Digital Link" URL based on such a string. The numeric component should also have a \[valid GS1 check digit\](https://www.gs1.org/services/check-digit-calculator) and meet the other rules for valid GTINs. See also \[GS1's GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) and \[Wikipedia\](https://en.wikipedia.org/wiki/Global\_Trade\_Item\_Number) for more details. Left-padding of the gtin values is not required or encouraged. The \[\[gtin\]\] property generalizes the earlier \[\[gtin8\]\], \[\[gtin12\]\], \[\[gtin13\]\], and \[\[gtin14\]\] properties. Note also that this is a definition for how to include GTINs in Schema.org data, and not a definition of GTINs in general - see the GS1 documentation for authoritative details.
     *
     * @see https://schema.org/gtin
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/gtin'])]
    private ?string $gtin = null;

    /**
     * @var Collection<LoanOrCredit>|null the payment method(s) accepted by seller for this offer
     *
     * @see https://schema.org/acceptedPaymentMethod
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\LoanOrCredit')]
    #[ORM\JoinTable(name: 'demand_loan_or_credit_accepted_payment_method')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/acceptedPaymentMethod'])]
    private ?Collection $acceptedPaymentMethod = null;

    /**
     * The current approximate inventory level for the item or items.
     *
     * @see https://schema.org/inventoryLevel
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/inventoryLevel'])]
    private ?QuantitativeValue $inventoryLevel = null;

    /**
     * An entity which offers (sells / leases / lends / loans) the services / goods. A seller may also be a provider.
     *
     * @see https://schema.org/seller
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/seller'])]
    #[Assert\NotNull]
    private Person $seller;

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
     * The GTIN-12 code of the product, or the product to which the offer refers. The GTIN-12 is the 12-digit GS1 Identification Key composed of a U.P.C. Company Prefix, Item Reference, and Check Digit used to identify trade items. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
     *
     * @see https://schema.org/gtin12
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/gtin12'])]
    private ?string $gtin12 = null;

    /**
     * @var string[]|null the type(s) of customers for which the given offer is valid
     *
     * @see https://schema.org/eligibleCustomerType
     */
    #[ORM\Column(type: 'simple_array', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/eligibleCustomerType'])]
    #[Assert\Choice(callback: [BusinessEntityType::class, 'toArray'], multiple: true)]
    private ?Collection $eligibleCustomerType = null;

    /**
     * @var Collection<Text>|null The serial number or any alphanumeric identifier of a particular product. When attached to an offer, it is a shortcut for the serial number of the product included in the offer.
     *
     * @see https://schema.org/serialNumber
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'demand_text_serial_number')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/serialNumber'])]
    private ?Collection $serialNumber = null;

    /**
     * An Amazon Standard Identification Number (ASIN) is a 10-character alphanumeric unique identifier assigned by Amazon.com and its partners for product identification within the Amazon organization (summary from \[Wikipedia\](https://en.wikipedia.org/wiki/Amazon\_Standard\_Identification\_Number)'s article). Note also that this is a definition for how to include ASINs in Schema.org data, and not a definition of ASINs in general - see documentation from Amazon for authoritative details. ASINs are most commonly encoded as text strings, but the \[asin\] property supports URL/URI as potential values too.
     *
     * @see https://schema.org/asin
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/asin'])]
    #[Assert\Url]
    private ?string $asin = null;

    /**
     * The end of the availability of the product or service included in the offer.
     *
     * @see https://schema.org/availabilityEnds
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/availabilityEnds'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $availabilityEnds = null;

    /**
     * @var Collection<TypeAndQuantityNode>|null this links to a node or nodes indicating the exact quantity of the products included in an \[\[Offer\]\] or \[\[ProductCollection\]\]
     *
     * @see https://schema.org/includesObject
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\TypeAndQuantityNode')]
    #[ORM\JoinTable(name: 'demand_type_and_quantity_node_includes_object')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/includesObject'])]
    private ?Collection $includesObject = null;

    /**
     * The interval and unit of measurement of ordering quantities for which the offer or price specification is valid. This allows e.g. specifying that a certain freight charge is valid only for a certain quantity.
     *
     * @see https://schema.org/eligibleQuantity
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/eligibleQuantity'])]
    private ?QuantitativeValue $eligibleQuantity = null;

    /**
     * @var string[]|null the delivery method(s) available for this offer
     *
     * @see https://schema.org/availableDeliveryMethod
     */
    #[ORM\Column(type: 'simple_array', nullable: true)]
    #[ApiProperty(types: ['https://schema.org/availableDeliveryMethod'])]
    #[Assert\Choice(callback: [DeliveryMethod::class, 'toArray'], multiple: true)]
    private ?Collection $availableDeliveryMethod = null;

    /**
     * @var Collection<Text>|null The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is not valid, e.g. a region where the transaction is not allowed.\\n\\nSee also \[\[eligibleRegion\]\].
     *
     * @see https://schema.org/ineligibleRegion
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'demand_text_ineligible_region')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/ineligibleRegion'])]
    private ?Collection $ineligibleRegion = null;

    /**
     * @var Collection<Text>|null The GTIN-13 code of the product, or the product to which the offer refers. This is equivalent to 13-digit ISBN codes and EAN UCC-13. Former 12-digit UPC codes can be converted into a GTIN-13 code by simply adding a preceding zero. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
     *
     * @see https://schema.org/gtin13
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'demand_text_gtin13')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/gtin13'])]
    private ?Collection $gtin13 = null;

    /**
     * The amount of time that is required between accepting the offer and the actual usage of the resource or service.
     *
     * @see https://schema.org/advanceBookingRequirement
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/advanceBookingRequirement'])]
    private ?QuantitativeValue $advanceBookingRequirement = null;

    /**
     * @var Collection<Text>|null The GTIN-14 code of the product, or the product to which the offer refers. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
     *
     * @see https://schema.org/gtin14
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'demand_text_gtin14')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/gtin14'])]
    private ?Collection $gtin14 = null;

    /**
     * @var Collection<GeoShape>|null The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid.\\n\\nSee also \[\[ineligibleRegion\]\].
     *
     * @see https://schema.org/eligibleRegion
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\GeoShape')]
    #[ORM\JoinTable(name: 'demand_geo_shape_eligible_region')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/eligibleRegion'])]
    private ?Collection $eligibleRegion = null;

    /**
     * The geographic area where a service or offered item is provided.
     *
     * @see https://schema.org/areaServed
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/areaServed'])]
    private ?string $areaServed = null;

    /**
     * @var Collection<WarrantyPromise>|null the warranty promise(s) included in the offer
     *
     * @see https://schema.org/warranty
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\WarrantyPromise')]
    #[ORM\JoinTable(name: 'demand_warranty_promise_warranty')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/warranty'])]
    private ?Collection $warranty = null;

    /**
     * The duration for which the given offer is valid.
     *
     * @see https://schema.org/eligibleDuration
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/eligibleDuration'])]
    private ?QuantitativeValue $eligibleDuration = null;

    /**
     * @var Collection<Text>|null the Manufacturer Part Number (MPN) of the product, or the product to which the offer refers
     *
     * @see https://schema.org/mpn
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'demand_text_mpn')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/mpn'])]
    private ?Collection $mpn = null;

    /**
     * The date when the item becomes valid.
     *
     * @see https://schema.org/validFrom
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/validFrom'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $validFrom = null;

    /**
     * The beginning of the availability of the product or service included in the offer.
     *
     * @see https://schema.org/availabilityStarts
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/availabilityStarts'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $availabilityStarts = null;

    /**
     * The date after when the item is not valid. For example the end of an offer, salary period, or a period of opening hours.
     *
     * @see https://schema.org/validThrough
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/validThrough'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $validThrough = null;

    /**
     * The availability of this item—for example In stock, Out of stock, Pre-order, etc.
     *
     * @see https://schema.org/availability
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/availability'])]
    #[Assert\Choice(callback: [ItemAvailability::class, 'toArray'])]
    private ?string $availability = null;

    /**
     * @var Collection<Place>|null The place(s) from which the offer can be obtained (e.g. store locations).
     *
     * @see https://schema.org/availableAtOrFrom
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Place')]
    #[ORM\JoinTable(name: 'demand_place_available_at_or_from')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/availableAtOrFrom'])]
    private ?Collection $availableAtOrFrom = null;

    /**
     * An item being offered (or demanded). The transactional nature of the offer or demand is documented using \[\[businessFunction\]\], e.g. sell, lease etc. While several common expected types are listed explicitly in this definition, others can be used. Using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
     *
     * @see https://schema.org/itemOffered
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
    #[ApiProperty(types: ['https://schema.org/itemOffered'])]
    private ?CreativeWork $itemOffered = null;

    public function __construct()
    {
        $this->sku = new ArrayCollection();
        $this->priceSpecification = new ArrayCollection();
        $this->gtin8 = new ArrayCollection();
        $this->acceptedPaymentMethod = new ArrayCollection();
        $this->serialNumber = new ArrayCollection();
        $this->includesObject = new ArrayCollection();
        $this->ineligibleRegion = new ArrayCollection();
        $this->gtin13 = new ArrayCollection();
        $this->gtin14 = new ArrayCollection();
        $this->eligibleRegion = new ArrayCollection();
        $this->warranty = new ArrayCollection();
        $this->mpn = new ArrayCollection();
        $this->availableAtOrFrom = new ArrayCollection();
    }

    public function addSku(string $sku): void
    {
        $this->sku[] = $sku;
    }

    public function removeSku(string $sku): void
    {
        $this->sku->removeElement($sku);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getSku(): Collection
    {
        return $this->sku;
    }

    public function setEligibleTransactionVolume(?PriceSpecification $eligibleTransactionVolume): void
    {
        $this->eligibleTransactionVolume = $eligibleTransactionVolume;
    }

    public function getEligibleTransactionVolume(): ?PriceSpecification
    {
        return $this->eligibleTransactionVolume;
    }

    public function addBusinessFunction($businessFunction): void
    {
        $this->businessFunction[] = (string) $businessFunction;
    }

    public function removeBusinessFunction(string $businessFunction): void
    {
        if (false !== $key = array_search((string) $businessFunction, $this->businessFunction, true)) {
            unset($this->businessFunction[$key]);
        }
    }

    /**
     * @return string[]
     */
    public function getBusinessFunction(): Collection
    {
        return $this->businessFunction;
    }

    public function setDeliveryLeadTime(?QuantitativeValue $deliveryLeadTime): void
    {
        $this->deliveryLeadTime = $deliveryLeadTime;
    }

    public function getDeliveryLeadTime(): ?QuantitativeValue
    {
        return $this->deliveryLeadTime;
    }

    public function addPriceSpecification(PriceSpecification $priceSpecification): void
    {
        $this->priceSpecification[] = $priceSpecification;
    }

    public function removePriceSpecification(PriceSpecification $priceSpecification): void
    {
        $this->priceSpecification->removeElement($priceSpecification);
    }

    /**
     * @return Collection<PriceSpecification>|null
     */
    public function getPriceSpecification(): Collection
    {
        return $this->priceSpecification;
    }

    public function addGtin8(string $gtin8): void
    {
        $this->gtin8[] = $gtin8;
    }

    public function removeGtin8(string $gtin8): void
    {
        $this->gtin8->removeElement($gtin8);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getGtin8(): Collection
    {
        return $this->gtin8;
    }

    public function setGtin(?string $gtin): void
    {
        $this->gtin = $gtin;
    }

    public function getGtin(): ?string
    {
        return $this->gtin;
    }

    public function addAcceptedPaymentMethod(LoanOrCredit $acceptedPaymentMethod): void
    {
        $this->acceptedPaymentMethod[] = $acceptedPaymentMethod;
    }

    public function removeAcceptedPaymentMethod(LoanOrCredit $acceptedPaymentMethod): void
    {
        $this->acceptedPaymentMethod->removeElement($acceptedPaymentMethod);
    }

    /**
     * @return Collection<LoanOrCredit>|null
     */
    public function getAcceptedPaymentMethod(): Collection
    {
        return $this->acceptedPaymentMethod;
    }

    public function setInventoryLevel(?QuantitativeValue $inventoryLevel): void
    {
        $this->inventoryLevel = $inventoryLevel;
    }

    public function getInventoryLevel(): ?QuantitativeValue
    {
        return $this->inventoryLevel;
    }

    public function setSeller(Person $seller): void
    {
        $this->seller = $seller;
    }

    public function getSeller(): Person
    {
        return $this->seller;
    }

    public function setItemCondition(string $itemCondition): void
    {
        $this->itemCondition = $itemCondition;
    }

    public function getItemCondition(): string
    {
        return $this->itemCondition;
    }

    public function setGtin12(?string $gtin12): void
    {
        $this->gtin12 = $gtin12;
    }

    public function getGtin12(): ?string
    {
        return $this->gtin12;
    }

    public function addEligibleCustomerType($eligibleCustomerType): void
    {
        $this->eligibleCustomerType[] = (string) $eligibleCustomerType;
    }

    public function removeEligibleCustomerType(string $eligibleCustomerType): void
    {
        if (false !== $key = array_search((string) $eligibleCustomerType, $this->eligibleCustomerType ?? [], true)) {
            unset($this->eligibleCustomerType[$key]);
        }
    }

    /**
     * @return string[]|null
     */
    public function getEligibleCustomerType(): Collection
    {
        return $this->eligibleCustomerType;
    }

    public function addSerialNumber(string $serialNumber): void
    {
        $this->serialNumber[] = $serialNumber;
    }

    public function removeSerialNumber(string $serialNumber): void
    {
        $this->serialNumber->removeElement($serialNumber);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getSerialNumber(): Collection
    {
        return $this->serialNumber;
    }

    public function setAsin(?string $asin): void
    {
        $this->asin = $asin;
    }

    public function getAsin(): ?string
    {
        return $this->asin;
    }

    public function setAvailabilityEnds(?\DateTimeInterface $availabilityEnds): void
    {
        $this->availabilityEnds = $availabilityEnds;
    }

    public function getAvailabilityEnds(): ?\DateTimeInterface
    {
        return $this->availabilityEnds;
    }

    public function addIncludesObject(TypeAndQuantityNode $includesObject): void
    {
        $this->includesObject[] = $includesObject;
    }

    public function removeIncludesObject(TypeAndQuantityNode $includesObject): void
    {
        $this->includesObject->removeElement($includesObject);
    }

    /**
     * @return Collection<TypeAndQuantityNode>|null
     */
    public function getIncludesObject(): Collection
    {
        return $this->includesObject;
    }

    public function setEligibleQuantity(?QuantitativeValue $eligibleQuantity): void
    {
        $this->eligibleQuantity = $eligibleQuantity;
    }

    public function getEligibleQuantity(): ?QuantitativeValue
    {
        return $this->eligibleQuantity;
    }

    public function addAvailableDeliveryMethod($availableDeliveryMethod): void
    {
        $this->availableDeliveryMethod[] = (string) $availableDeliveryMethod;
    }

    public function removeAvailableDeliveryMethod(string $availableDeliveryMethod): void
    {
        if (false !== $key = array_search((string) $availableDeliveryMethod, $this->availableDeliveryMethod ?? [], true)) {
            unset($this->availableDeliveryMethod[$key]);
        }
    }

    /**
     * @return string[]|null
     */
    public function getAvailableDeliveryMethod(): Collection
    {
        return $this->availableDeliveryMethod;
    }

    public function addIneligibleRegion(string $ineligibleRegion): void
    {
        $this->ineligibleRegion[] = $ineligibleRegion;
    }

    public function removeIneligibleRegion(string $ineligibleRegion): void
    {
        $this->ineligibleRegion->removeElement($ineligibleRegion);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getIneligibleRegion(): Collection
    {
        return $this->ineligibleRegion;
    }

    public function addGtin13(string $gtin13): void
    {
        $this->gtin13[] = $gtin13;
    }

    public function removeGtin13(string $gtin13): void
    {
        $this->gtin13->removeElement($gtin13);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getGtin13(): Collection
    {
        return $this->gtin13;
    }

    public function setAdvanceBookingRequirement(?QuantitativeValue $advanceBookingRequirement): void
    {
        $this->advanceBookingRequirement = $advanceBookingRequirement;
    }

    public function getAdvanceBookingRequirement(): ?QuantitativeValue
    {
        return $this->advanceBookingRequirement;
    }

    public function addGtin14(string $gtin14): void
    {
        $this->gtin14[] = $gtin14;
    }

    public function removeGtin14(string $gtin14): void
    {
        $this->gtin14->removeElement($gtin14);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getGtin14(): Collection
    {
        return $this->gtin14;
    }

    public function addEligibleRegion(GeoShape $eligibleRegion): void
    {
        $this->eligibleRegion[] = $eligibleRegion;
    }

    public function removeEligibleRegion(GeoShape $eligibleRegion): void
    {
        $this->eligibleRegion->removeElement($eligibleRegion);
    }

    /**
     * @return Collection<GeoShape>|null
     */
    public function getEligibleRegion(): Collection
    {
        return $this->eligibleRegion;
    }

    public function setAreaServed(?string $areaServed): void
    {
        $this->areaServed = $areaServed;
    }

    public function getAreaServed(): ?string
    {
        return $this->areaServed;
    }

    public function addWarranty(WarrantyPromise $warranty): void
    {
        $this->warranty[] = $warranty;
    }

    public function removeWarranty(WarrantyPromise $warranty): void
    {
        $this->warranty->removeElement($warranty);
    }

    /**
     * @return Collection<WarrantyPromise>|null
     */
    public function getWarranty(): Collection
    {
        return $this->warranty;
    }

    public function setEligibleDuration(?QuantitativeValue $eligibleDuration): void
    {
        $this->eligibleDuration = $eligibleDuration;
    }

    public function getEligibleDuration(): ?QuantitativeValue
    {
        return $this->eligibleDuration;
    }

    public function addMpn(string $mpn): void
    {
        $this->mpn[] = $mpn;
    }

    public function removeMpn(string $mpn): void
    {
        $this->mpn->removeElement($mpn);
    }

    /**
     * @return Collection<Text>|null
     */
    public function getMpn(): Collection
    {
        return $this->mpn;
    }

    public function setValidFrom(?\DateTimeInterface $validFrom): void
    {
        $this->validFrom = $validFrom;
    }

    public function getValidFrom(): ?\DateTimeInterface
    {
        return $this->validFrom;
    }

    public function setAvailabilityStarts(?\DateTimeInterface $availabilityStarts): void
    {
        $this->availabilityStarts = $availabilityStarts;
    }

    public function getAvailabilityStarts(): ?\DateTimeInterface
    {
        return $this->availabilityStarts;
    }

    public function setValidThrough(?\DateTimeInterface $validThrough): void
    {
        $this->validThrough = $validThrough;
    }

    public function getValidThrough(): ?\DateTimeInterface
    {
        return $this->validThrough;
    }

    public function setAvailability(?string $availability): void
    {
        $this->availability = $availability;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function addAvailableAtOrFrom(Place $availableAtOrFrom): void
    {
        $this->availableAtOrFrom[] = $availableAtOrFrom;
    }

    public function removeAvailableAtOrFrom(Place $availableAtOrFrom): void
    {
        $this->availableAtOrFrom->removeElement($availableAtOrFrom);
    }

    /**
     * @return Collection<Place>|null
     */
    public function getAvailableAtOrFrom(): Collection
    {
        return $this->availableAtOrFrom;
    }

    public function setItemOffered(?CreativeWork $itemOffered): void
    {
        $this->itemOffered = $itemOffered;
    }

    public function getItemOffered(): ?CreativeWork
    {
        return $this->itemOffered;
    }
}

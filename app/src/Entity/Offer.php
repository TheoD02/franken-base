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
use App\Enum\AdultOrientedEnumeration;
use App\Enum\BusinessEntityType;
use App\Enum\BusinessFunction;
use App\Enum\DeliveryMethod;
use App\Enum\ItemAvailability;
use App\Enum\OfferItemCondition;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An offer to transfer some rights to an item or to provide a service — for example, an offer to sell tickets to an event, to rent the DVD of a movie, to stream a TV show over the internet, to repair a motorcycle, or to loan a book.\\n\\nNote: As the \[\[businessFunction\]\] property, which identifies the form of offer (e.g. sell, lease, repair, dispose), defaults to http://purl.org/goodrelations/v1#Sell; an Offer without a defined businessFunction value can be assumed to be an offer to sell.\\n\\nFor \[GTIN\](http://www.gs1.org/barcodes/technical/idkeys/gtin)-related fields, see \[Check Digit calculator\](http://www.gs1.org/barcodes/support/check\_digit\_calculator) and \[validation guide\](http://www.gs1us.org/resources/standards/gtin-validation-guide) from \[GS1\](http://www.gs1.org/).
 *
 * @see https://schema.org/Offer
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'offer' => Offer::class,
	'offerForLease' => OfferForLease::class,
	'offerForPurchase' => OfferForPurchase::class,
	'aggregateOffer' => AggregateOffer::class,
])]
class Offer extends Intangible
{
	/**
	 * @var Collection<Text>|null The Stock Keeping Unit (SKU), i.e. a merchant-specific identifier for a product or service, or the product to which the offer refers.
	 * @see https://schema.org/sku
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'offer_text_sku')]
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
	 * @var Collection<Offer>|null An additional offer that can only be obtained in combination with the first base offer (e.g. supplements and extensions that are available for a surcharge).
	 * @see https://schema.org/addOn
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Offer')]
	#[ORM\JoinTable(name: 'offer_offer_add_on')]
	#[ORM\InverseJoinColumn(name: 'add_on_offer_id', unique: true)]
	#[ApiProperty(types: ['https://schema.org/addOn'])]
	private ?Collection $addOn = null;

	/**
	 * @var string[] The business function (e.g. sell, lease, repair, dispose) of the offer or component of a bundle (TypeAndQuantityNode). The default is http://purl.org/goodrelations/v1#Sell.
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
	 * A measurement of an item, For example, the inseam of pants, the wheel size of a bicycle, the gauge of a screw, or the carbon footprint measured for certification by an authority. Usually an exact measurement, but can also be a range of measurements for adjustable products, for example belts and ski bindings.
	 *
	 * @see https://schema.org/hasMeasurement
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasMeasurement'])]
	#[Assert\NotNull]
	private QuantitativeValue $hasMeasurement;

	/**
	 * @var Collection<PriceSpecification>|null One or more detailed price specifications, indicating the unit price and delivery or payment charges.
	 * @see https://schema.org/priceSpecification
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\PriceSpecification')]
	#[ORM\JoinTable(name: 'offer_price_specification_price_specification')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/priceSpecification'])]
	private ?Collection $priceSpecification = null;

	/**
	 * @var Collection<Text>|null The GTIN-8 code of the product, or the product to which the offer refers. This code is also known as EAN/UCC-8 or 8-digit EAN. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
	 * @see https://schema.org/gtin8
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'offer_text_gtin8')]
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
	 * @var Collection<LoanOrCredit>|null The payment method(s) accepted by seller for this offer.
	 * @see https://schema.org/acceptedPaymentMethod
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\LoanOrCredit')]
	#[ORM\JoinTable(name: 'offer_loan_or_credit_accepted_payment_method')]
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
	 * The GTIN-12 code of the product, or the product to which the offer refers. The GTIN-12 is the 12-digit GS1 Identification Key composed of a U.P.C. Company Prefix, Item Reference, and Check Digit used to identify trade items. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
	 *
	 * @see https://schema.org/gtin12
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/gtin12'])]
	private ?string $gtin12 = null;

	/**
	 * Used to tag an item to be intended or suitable for consumption or use by adults only.
	 *
	 * @see https://schema.org/hasAdultConsideration
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/hasAdultConsideration'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [AdultOrientedEnumeration::class, 'toArray'])]
	private string $hasAdultConsideration;

	/**
	 * The currency of the price, or a price component when attached to \[\[PriceSpecification\]\] and its subtypes.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
	 *
	 * @see https://schema.org/priceCurrency
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/priceCurrency'])]
	#[Assert\NotNull]
	private string $priceCurrency;

	/**
	 * @var string[]|null The type(s) of customers for which the given offer is valid.
	 * @see https://schema.org/eligibleCustomerType
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/eligibleCustomerType'])]
	#[Assert\Choice(callback: [BusinessEntityType::class, 'toArray'], multiple: true)]
	private ?Collection $eligibleCustomerType = null;

	/**
	 * @var Collection<Text>|null The serial number or any alphanumeric identifier of a particular product. When attached to an offer, it is a shortcut for the serial number of the product included in the offer.
	 * @see https://schema.org/serialNumber
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'offer_text_serial_number')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/serialNumber'])]
	private ?Collection $serialNumber = null;

	/**
	 * The overall rating, based on a collection of reviews or ratings, of the item.
	 *
	 * @see https://schema.org/aggregateRating
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AggregateRating')]
	#[ApiProperty(types: ['https://schema.org/aggregateRating'])]
	private ?AggregateRating $aggregateRating = null;

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
	 * @var Collection<Text>|null A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.
	 * @see https://schema.org/category
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'offer_text_category')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/category'])]
	private ?Collection $category = null;

	/**
	 * The offer price of a product, or of a price component when attached to PriceSpecification and its subtypes.\\n\\nUsage guidelines:\\n\\n\* Use the \[\[priceCurrency\]\] property (with standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR") instead of including \[ambiguous symbols\](http://en.wikipedia.org/wiki/Dollar\_sign#Currencies\_that\_use\_the\_dollar\_or\_peso\_sign) such as '$' in the value.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.\\n\* Note that both \[RDFa\](http://www.w3.org/TR/xhtml-rdfa-primer/#using-the-content-attribute) and Microdata syntax allow the use of a "content=" attribute for publishing simple machine-readable values alongside more human-friendly formatting.\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.
	 *
	 * @see https://schema.org/price
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/price'])]
	private ?string $price = null;

	/**
	 * The \[\[mobileUrl\]\] property is provided for specific situations in which data consumers need to determine whether one of several provided URLs is a dedicated 'mobile site'. To discourage over-use, and reflecting intial usecases, the property is expected only on \[\[Product\]\] and \[\[Offer\]\], rather than \[\[Thing\]\]. The general trend in web technology is towards \[responsive design\](https://en.wikipedia.org/wiki/Responsive\_web\_design) in which content can be flexibly adapted to a wide range of browsing environments. Pages and sites referenced with the long-established \[\[url\]\] property should ideally also be usable on a wide variety of devices, including mobile phones. In most cases, it would be pointless and counter productive to attempt to update all \[\[url\]\] markup to use \[\[mobileUrl\]\] for more mobile-oriented pages. The property is intended for the case when items (primarily \[\[Product\]\] and \[\[Offer\]\]) have extra URLs hosted on an additional "mobile site" alongside the main one. It should not be taken as an endorsement of this publication style.
	 *
	 * @see https://schema.org/mobileUrl
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/mobileUrl'])]
	private ?string $mobileUrl = null;

	/**
	 * @var Collection<TypeAndQuantityNode>|null This links to a node or nodes indicating the exact quantity of the products included in an \[\[Offer\]\] or \[\[ProductCollection\]\].
	 * @see https://schema.org/includesObject
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\TypeAndQuantityNode')]
	#[ORM\JoinTable(name: 'offer_type_and_quantity_node_includes_object')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/includesObject'])]
	private ?Collection $includesObject = null;

	/**
	 * The date after which the price is no longer available.
	 *
	 * @see https://schema.org/priceValidUntil
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/priceValidUntil'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $priceValidUntil = null;

	/**
	 * The interval and unit of measurement of ordering quantities for which the offer or price specification is valid. This allows e.g. specifying that a certain freight charge is valid only for a certain quantity.
	 *
	 * @see https://schema.org/eligibleQuantity
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/eligibleQuantity'])]
	private ?QuantitativeValue $eligibleQuantity = null;

	/**
	 * @var string[]|null The delivery method(s) available for this offer.
	 * @see https://schema.org/availableDeliveryMethod
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/availableDeliveryMethod'])]
	#[Assert\Choice(callback: [DeliveryMethod::class, 'toArray'], multiple: true)]
	private ?Collection $availableDeliveryMethod = null;

	/**
	 * @var Collection<Text>|null The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is not valid, e.g. a region where the transaction is not allowed.\\n\\nSee also \[\[eligibleRegion\]\].
	 * @see https://schema.org/ineligibleRegion
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'offer_text_ineligible_region')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/ineligibleRegion'])]
	private ?Collection $ineligibleRegion = null;

	/**
	 * @var Collection<Text>|null The GTIN-13 code of the product, or the product to which the offer refers. This is equivalent to 13-digit ISBN codes and EAN UCC-13. Former 12-digit UPC codes can be converted into a GTIN-13 code by simply adding a preceding zero. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
	 * @see https://schema.org/gtin13
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'offer_text_gtin13')]
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
	 * @see https://schema.org/gtin14
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'offer_text_gtin14')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/gtin14'])]
	private ?Collection $gtin14 = null;

	/**
	 * @var Collection<GeoShape>|null The ISO 3166-1 (ISO 3166-1 alpha-2) or ISO 3166-2 code, the place, or the GeoShape for the geo-political region(s) for which the offer or delivery charge specification is valid.\\n\\nSee also \[\[ineligibleRegion\]\].
	 * @see https://schema.org/eligibleRegion
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\GeoShape')]
	#[ORM\JoinTable(name: 'offer_geo_shape_eligible_region')]
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
	 * @var Collection<WarrantyPromise>|null The warranty promise(s) included in the offer.
	 * @see https://schema.org/warranty
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\WarrantyPromise')]
	#[ORM\JoinTable(name: 'offer_warranty_promise_warranty')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/warranty'])]
	private ?Collection $warranty = null;

	/**
	 * Indicates whether this content is family friendly.
	 *
	 * @see https://schema.org/isFamilyFriendly
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/isFamilyFriendly'])]
	private ?bool $isFamilyFriendly = null;

	/**
	 * The duration for which the given offer is valid.
	 *
	 * @see https://schema.org/eligibleDuration
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/eligibleDuration'])]
	private ?QuantitativeValue $eligibleDuration = null;

	/**
	 * @var Collection<Text>|null The Manufacturer Part Number (MPN) of the product, or the product to which the offer refers.
	 * @see https://schema.org/mpn
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'offer_text_mpn')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/mpn'])]
	private ?Collection $mpn = null;

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
	 * Indicates information about the shipping policies and options associated with an \[\[Offer\]\].
	 *
	 * @see https://schema.org/shippingDetails
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\OfferShippingDetails')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/shippingDetails'])]
	#[Assert\NotNull]
	private OfferShippingDetails $shippingDetails;

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
	 * @see https://schema.org/availableAtOrFrom
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinTable(name: 'offer_place_available_at_or_from')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/availableAtOrFrom'])]
	private ?Collection $availableAtOrFrom = null;

	/**
	 * A URL template (RFC 6570) for a checkout page for an offer. This approach allows merchants to specify a URL for online checkout of the offered product, by interpolating parameters such as the logged in user ID, product ID, quantity, discount code etc. Parameter naming and standardization are not specified here.
	 *
	 * @see https://schema.org/checkoutPageURLTemplate
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/checkoutPageURLTemplate'])]
	private ?string $checkoutPageURLTemplate = null;

	/**
	 * Specifies a MerchantReturnPolicy that may be applicable.
	 *
	 * @see https://schema.org/hasMerchantReturnPolicy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MerchantReturnPolicy')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasMerchantReturnPolicy'])]
	#[Assert\NotNull]
	private MerchantReturnPolicy $hasMerchantReturnPolicy;

	/**
	 * A pointer to the organization or person making the offer.
	 *
	 * @see https://schema.org/offeredBy
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/offeredBy'])]
	#[Assert\NotNull]
	private Person $offeredBy;

	/**
	 * An item being offered (or demanded). The transactional nature of the offer or demand is documented using \[\[businessFunction\]\], e.g. sell, lease etc. While several common expected types are listed explicitly in this definition, others can be used. Using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
	 *
	 * @see https://schema.org/itemOffered
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\CreativeWork')]
	#[ApiProperty(types: ['https://schema.org/itemOffered'])]
	private ?CreativeWork $itemOffered = null;

	function __construct()
	{
		$this->sku = new ArrayCollection();
		$this->addOn = new ArrayCollection();
		$this->priceSpecification = new ArrayCollection();
		$this->gtin8 = new ArrayCollection();
		$this->acceptedPaymentMethod = new ArrayCollection();
		$this->serialNumber = new ArrayCollection();
		$this->category = new ArrayCollection();
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

	public function addAddOn(Offer $addOn): void
	{
		$this->addOn[] = $addOn;
	}

	public function removeAddOn(Offer $addOn): void
	{
		$this->addOn->removeElement($addOn);
	}

	/**
	 * @return Collection<Offer>|null
	 */
	public function getAddOn(): Collection
	{
		return $this->addOn;
	}

	public function addBusinessFunction($businessFunction): void
	{
		$this->businessFunction[] = (string) $businessFunction;
	}

	public function removeBusinessFunction(string $businessFunction): void
	{
		if (false !== $key = array_search((string)$businessFunction, $this->businessFunction, true)) {
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

	public function setHasMeasurement(QuantitativeValue $hasMeasurement): void
	{
		$this->hasMeasurement = $hasMeasurement;
	}

	public function getHasMeasurement(): QuantitativeValue
	{
		return $this->hasMeasurement;
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

	public function setAdditionalProperty(PropertyValue $additionalProperty): void
	{
		$this->additionalProperty = $additionalProperty;
	}

	public function getAdditionalProperty(): PropertyValue
	{
		return $this->additionalProperty;
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

	public function setLeaseLength(QuantitativeValue $leaseLength): void
	{
		$this->leaseLength = $leaseLength;
	}

	public function getLeaseLength(): QuantitativeValue
	{
		return $this->leaseLength;
	}

	public function setGtin12(?string $gtin12): void
	{
		$this->gtin12 = $gtin12;
	}

	public function getGtin12(): ?string
	{
		return $this->gtin12;
	}

	public function setHasAdultConsideration(string $hasAdultConsideration): void
	{
		$this->hasAdultConsideration = $hasAdultConsideration;
	}

	public function getHasAdultConsideration(): string
	{
		return $this->hasAdultConsideration;
	}

	public function setPriceCurrency(string $priceCurrency): void
	{
		$this->priceCurrency = $priceCurrency;
	}

	public function getPriceCurrency(): string
	{
		return $this->priceCurrency;
	}

	public function addEligibleCustomerType($eligibleCustomerType): void
	{
		$this->eligibleCustomerType[] = (string) $eligibleCustomerType;
	}

	public function removeEligibleCustomerType(string $eligibleCustomerType): void
	{
		if (false !== $key = array_search((string)$eligibleCustomerType, $this->eligibleCustomerType ?? [], true)) {
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

	public function setAggregateRating(?AggregateRating $aggregateRating): void
	{
		$this->aggregateRating = $aggregateRating;
	}

	public function getAggregateRating(): ?AggregateRating
	{
		return $this->aggregateRating;
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

	public function addCategory(string $category): void
	{
		$this->category[] = $category;
	}

	public function removeCategory(string $category): void
	{
		$this->category->removeElement($category);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getCategory(): Collection
	{
		return $this->category;
	}

	public function setPrice(?string $price): void
	{
		$this->price = $price;
	}

	public function getPrice(): ?string
	{
		return $this->price;
	}

	public function setMobileUrl(?string $mobileUrl): void
	{
		$this->mobileUrl = $mobileUrl;
	}

	public function getMobileUrl(): ?string
	{
		return $this->mobileUrl;
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

	public function setPriceValidUntil(?\DateTimeInterface $priceValidUntil): void
	{
		$this->priceValidUntil = $priceValidUntil;
	}

	public function getPriceValidUntil(): ?\DateTimeInterface
	{
		return $this->priceValidUntil;
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
		if (false !== $key = array_search((string)$availableDeliveryMethod, $this->availableDeliveryMethod ?? [], true)) {
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

	public function setIsFamilyFriendly(?bool $isFamilyFriendly): void
	{
		$this->isFamilyFriendly = $isFamilyFriendly;
	}

	public function getIsFamilyFriendly(): ?bool
	{
		return $this->isFamilyFriendly;
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

	public function setReview(Review $review): void
	{
		$this->review = $review;
	}

	public function getReview(): Review
	{
		return $this->review;
	}

	public function setShippingDetails(OfferShippingDetails $shippingDetails): void
	{
		$this->shippingDetails = $shippingDetails;
	}

	public function getShippingDetails(): OfferShippingDetails
	{
		return $this->shippingDetails;
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

	public function setCheckoutPageURLTemplate(?string $checkoutPageURLTemplate): void
	{
		$this->checkoutPageURLTemplate = $checkoutPageURLTemplate;
	}

	public function getCheckoutPageURLTemplate(): ?string
	{
		return $this->checkoutPageURLTemplate;
	}

	public function setHasMerchantReturnPolicy(MerchantReturnPolicy $hasMerchantReturnPolicy): void
	{
		$this->hasMerchantReturnPolicy = $hasMerchantReturnPolicy;
	}

	public function getHasMerchantReturnPolicy(): MerchantReturnPolicy
	{
		return $this->hasMerchantReturnPolicy;
	}

	public function setOfferedBy(Person $offeredBy): void
	{
		$this->offeredBy = $offeredBy;
	}

	public function getOfferedBy(): Person
	{
		return $this->offeredBy;
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

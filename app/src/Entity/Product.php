<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use App\Enum\AdultOrientedEnumeration;
use App\Enum\OfferItemCondition;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Any offered product or service. For example: a pair of shoes; a concert ticket; the rental of a car; a haircut; or an episode of a TV show streamed online.
 *
 * @see https://schema.org/Product
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
    'product' => Product::class,
    'vehicle' => Vehicle::class,
    'dietarySupplement' => DietarySupplement::class,
    'drug' => Drug::class,
    'individualProduct' => IndividualProduct::class,
    'someProducts' => SomeProducts::class,
    'productModel' => ProductModel::class,
    'productGroup' => ProductGroup::class,
    'motorizedBicycle' => MotorizedBicycle::class,
    'motorcycle' => Motorcycle::class,
    'busOrCoach' => BusOrCoach::class,
    'car' => Car::class,
])]
class Product extends Thing
{
    /**
     * @var Collection<Text>|null The Stock Keeping Unit (SKU), i.e. a merchant-specific identifier for a product or service, or the product to which the offer refers.
     *
     * @see https://schema.org/sku
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'product_text_sku')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/sku'])]
    private ?Collection $sku = null;

    /**
     * Provides negative considerations regarding something, most typically in pro/con lists for reviews (alongside \[\[positiveNotes\]\]). For symmetry In the case of a \[\[Review\]\], the property describes the \[\[itemReviewed\]\] from the perspective of the review; in the case of a \[\[Product\]\], the product itself is being described. Since product descriptions tend to emphasise positive claims, it may be relatively unusual to find \[\[negativeNotes\]\] used in this way. Nevertheless for the sake of symmetry, \[\[negativeNotes\]\] can be used on \[\[Product\]\]. The property values can be expressed either as unstructured text (repeated as necessary), or if ordered, as a list (in which case the most negative is at the beginning of the list).
     *
     * @see https://schema.org/negativeNotes
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ItemList')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/negativeNotes'])]
    #[Assert\NotNull]
    private ItemList $negativeNotes;

    /**
     * A pointer to another, somehow related product (or multiple products).
     *
     * @see https://schema.org/isRelatedTo
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Product')]
    #[ApiProperty(types: ['https://schema.org/isRelatedTo'])]
    private ?Product $isRelatedTo = null;

    /**
     * The manufacturer of the product.
     *
     * @see https://schema.org/manufacturer
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
    #[ApiProperty(types: ['https://schema.org/manufacturer'])]
    private ?Organization $manufacturer = null;

    /**
     * @var Collection<Product>|null a pointer to another, functionally similar product (or multiple products)
     *
     * @see https://schema.org/isSimilarTo
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Product')]
    #[ORM\JoinTable(name: 'product_product_is_similar_to')]
    #[ORM\InverseJoinColumn(name: 'is_similar_to_product_id', unique: true)]
    #[ApiProperty(types: ['https://schema.org/isSimilarTo'])]
    private ?Collection $isSimilarTo = null;

    /**
     * A standardized size of a product or creative work, specified either through a simple textual string (for example 'XL', '32Wx34L'), a QuantitativeValue with a unitCode, or a comprehensive and structured \[\[SizeSpecification\]\]; in other cases, the \[\[width\]\], \[\[height\]\], \[\[depth\]\] and \[\[weight\]\] properties may be more applicable.
     *
     * @see https://schema.org/size
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/size'])]
    private ?string $size = null;

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
     * Defines the energy efficiency Category (also known as "class" or "rating") for a product according to an international energy efficiency standard.
     *
     * @see https://schema.org/hasEnergyConsumptionDetails
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\EnergyConsumptionDetails')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/hasEnergyConsumptionDetails'])]
    #[Assert\NotNull]
    private EnergyConsumptionDetails $hasEnergyConsumptionDetails;

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
     * An associated logo.
     *
     * @see https://schema.org/logo
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/logo'])]
    #[Assert\Url]
    private ?string $logo = null;

    /**
     * @var Collection<Text>|null The GTIN-8 code of the product, or the product to which the offer refers. This code is also known as EAN/UCC-8 or 8-digit EAN. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
     *
     * @see https://schema.org/gtin8
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'product_text_gtin8')]
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
     * The weight of the product or person.
     *
     * @see https://schema.org/weight
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/weight'])]
    private ?QuantitativeValue $weight = null;

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
     * The place where the item (typically \[\[Product\]\]) was last processed and tested before importation.
     *
     * @see https://schema.org/countryOfLastProcessing
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/countryOfLastProcessing'])]
    private ?string $countryOfLastProcessing = null;

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
     * The model of the product. Use with the URL of a ProductModel or a textual representation of the model identifier. The URL of the ProductModel can be from an external source. It is recommended to additionally provide strong product identifiers via the gtin8/gtin13/gtin14 and mpn properties.
     *
     * @see https://schema.org/model
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ProductModel')]
    #[ApiProperty(types: ['https://schema.org/model'])]
    private ?ProductModel $model = null;

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
     * The width of the item.
     *
     * @see https://schema.org/width
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/width'])]
    private ?QuantitativeValue $width = null;

    /**
     * Indicates the \[\[productGroupID\]\] for a \[\[ProductGroup\]\] that this product \[\[isVariantOf\]\].
     *
     * @see https://schema.org/inProductGroupWithID
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/inProductGroupWithID'])]
    private ?string $inProductGroupWithID = null;

    /**
     * The overall rating, based on a collection of reviews or ratings, of the item.
     *
     * @see https://schema.org/aggregateRating
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\AggregateRating')]
    #[ApiProperty(types: ['https://schema.org/aggregateRating'])]
    private ?AggregateRating $aggregateRating = null;

    /**
     * The color of the product.
     *
     * @see https://schema.org/color
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/color'])]
    private ?string $color = null;

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
     * Provides positive considerations regarding something, for example product highlights or (alongside \[\[negativeNotes\]\]) pro/con lists for reviews. In the case of a \[\[Review\]\], the property describes the \[\[itemReviewed\]\] from the perspective of the review; in the case of a \[\[Product\]\], the product itself is being described. The property values can be expressed either as unstructured text (repeated as necessary), or if ordered, as a list (in which case the most positive is at the beginning of the list).
     *
     * @see https://schema.org/positiveNotes
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ItemList')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/positiveNotes'])]
    #[Assert\NotNull]
    private ItemList $positiveNotes;

    /**
     * @var Collection<Text>|null A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.
     *
     * @see https://schema.org/category
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'product_text_category')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/category'])]
    private ?Collection $category = null;

    /**
     * Indicates the \[NATO stock number\](https://en.wikipedia.org/wiki/NATO\_Stock\_Number) (nsn) of a \[\[Product\]\].
     *
     * @see https://schema.org/nsn
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/nsn'])]
    private ?string $nsn = null;

    /**
     * The date of production of the item, e.g. vehicle.
     *
     * @see https://schema.org/productionDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/productionDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $productionDate = null;

    /**
     * The country of origin of something, including products as well as creative works such as movie and TV content. In the case of TV and movie, this would be the country of the principle offices of the production company or individual responsible for the movie. For other kinds of \[\[CreativeWork\]\] it is difficult to provide fully general guidance, and properties such as \[\[contentLocation\]\] and \[\[locationCreated\]\] may be more applicable. In the case of products, the country of origin of the product. The exact interpretation of this may vary by context and product type, and cannot be fully enumerated here.
     *
     * @see https://schema.org/countryOfOrigin
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Country')]
    #[ApiProperty(types: ['https://schema.org/countryOfOrigin'])]
    private ?Country $countryOfOrigin = null;

    /**
     * The \[\[mobileUrl\]\] property is provided for specific situations in which data consumers need to determine whether one of several provided URLs is a dedicated 'mobile site'. To discourage over-use, and reflecting intial usecases, the property is expected only on \[\[Product\]\] and \[\[Offer\]\], rather than \[\[Thing\]\]. The general trend in web technology is towards \[responsive design\](https://en.wikipedia.org/wiki/Responsive\_web\_design) in which content can be flexibly adapted to a wide range of browsing environments. Pages and sites referenced with the long-established \[\[url\]\] property should ideally also be usable on a wide variety of devices, including mobile phones. In most cases, it would be pointless and counter productive to attempt to update all \[\[url\]\] markup to use \[\[mobileUrl\]\] for more mobile-oriented pages. The property is intended for the case when items (primarily \[\[Product\]\] and \[\[Offer\]\]) have extra URLs hosted on an additional "mobile site" alongside the main one. It should not be taken as an endorsement of this publication style.
     *
     * @see https://schema.org/mobileUrl
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/mobileUrl'])]
    private ?string $mobileUrl = null;

    /**
     * An award won by or for this item.
     *
     * @see https://schema.org/award
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/award'])]
    private ?string $award = null;

    /**
     * The product identifier, such as ISBN. For example: ``` meta itemprop="productID" content="isbn:123-456-789" ```.
     *
     * @see https://schema.org/productID
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/productID'])]
    private ?string $productID = null;

    /**
     * Keywords or tags used to describe some item. Multiple textual entries in a keywords list are typically delimited by commas, or by repeating the property.
     *
     * @see https://schema.org/keywords
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/keywords'])]
    private ?string $keywords = null;

    /**
     * The date the item, e.g. vehicle, was purchased by the current owner.
     *
     * @see https://schema.org/purchaseDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/purchaseDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $purchaseDate = null;

    /**
     * @var Collection<Product>|null a pointer to another product (or multiple products) for which this product is a consumable
     *
     * @see https://schema.org/isConsumableFor
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Product')]
    #[ORM\JoinTable(name: 'product_product_is_consumable_for')]
    #[ORM\InverseJoinColumn(name: 'is_consumable_for_product_id', unique: true)]
    #[ApiProperty(types: ['https://schema.org/isConsumableFor'])]
    private ?Collection $isConsumableFor = null;

    /**
     * A pattern that something has, for example 'polka dot', 'striped', 'Canadian flag'. Values are typically expressed as text, although links to controlled value schemes are also supported.
     *
     * @see https://schema.org/pattern
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/pattern'])]
    #[Assert\NotNull]
    private DefinedTerm $pattern;

    /**
     * A material that something is made from, e.g. leather, wool, cotton, paper.
     *
     * @see https://schema.org/material
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/material'])]
    private ?string $material = null;

    /**
     * @var Collection<Text>|null The GTIN-13 code of the product, or the product to which the offer refers. This is equivalent to 13-digit ISBN codes and EAN UCC-13. Former 12-digit UPC codes can be converted into a GTIN-13 code by simply adding a preceding zero. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
     *
     * @see https://schema.org/gtin13
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'product_text_gtin13')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/gtin13'])]
    private ?Collection $gtin13 = null;

    /**
     * A slogan or motto associated with the item.
     *
     * @see https://schema.org/slogan
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/slogan'])]
    private ?string $slogan = null;

    /**
     * @var Collection<Text>|null The GTIN-14 code of the product, or the product to which the offer refers. See \[GS1 GTIN Summary\](http://www.gs1.org/barcodes/technical/idkeys/gtin) for more details.
     *
     * @see https://schema.org/gtin14
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'product_text_gtin14')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/gtin14'])]
    private ?Collection $gtin14 = null;

    /**
     * Indicates whether this content is family friendly.
     *
     * @see https://schema.org/isFamilyFriendly
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/isFamilyFriendly'])]
    private ?bool $isFamilyFriendly = null;

    /**
     * The place where the product was assembled.
     *
     * @see https://schema.org/countryOfAssembly
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/countryOfAssembly'])]
    private ?string $countryOfAssembly = null;

    /**
     * @var Collection<Text>|null the Manufacturer Part Number (MPN) of the product, or the product to which the offer refers
     *
     * @see https://schema.org/mpn
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
    #[ORM\JoinTable(name: 'product_text_mpn')]
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
     * @var Collection<Organization>|null the brand(s) associated with a product or service, or the brand(s) maintained by an organization or business person
     *
     * @see https://schema.org/brand
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Organization')]
    #[ORM\JoinTable(name: 'product_organization_brand')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/brand'])]
    private ?Collection $brand = null;

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
     * @var Collection<Product>|null a pointer to another product (or multiple products) for which this product is an accessory or spare part
     *
     * @see https://schema.org/isAccessoryOrSparePartFor
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Product')]
    #[ORM\JoinTable(name: 'product_product_is_accessory_or_spare_part_for')]
    #[ORM\InverseJoinColumn(name: 'is_accessory_or_spare_part_for_product_id', unique: true)]
    #[ApiProperty(types: ['https://schema.org/isAccessoryOrSparePartFor'])]
    private ?Collection $isAccessoryOrSparePartFor = null;

    /**
     * The height of the item.
     *
     * @see https://schema.org/height
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/height'])]
    private ?QuantitativeValue $height = null;

    /**
     * A color swatch image, visualizing the color of a \[\[Product\]\]. Should match the textual description specified in the \[\[color\]\] property. This can be a URL or a fully described ImageObject.
     *
     * @see https://schema.org/colorSwatch
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/colorSwatch'])]
    #[Assert\Url]
    private ?string $colorSwatch = null;

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
     * The depth of the item.
     *
     * @see https://schema.org/depth
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/depth'])]
    private ?QuantitativeValue $depth = null;

    /**
     * The release date of a product or product model. This can be used to distinguish the exact variant of a product.
     *
     * @see https://schema.org/releaseDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/releaseDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $releaseDate = null;

    /**
     * Indicates the kind of product that this is a variant of. In the case of \[\[ProductModel\]\], this is a pointer (from a ProductModel) to a base product from which this product is a variant. It is safe to infer that the variant inherits all product features from the base model, unless defined locally. This is not transitive. In the case of a \[\[ProductGroup\]\], the group description also serves as a template, representing a set of Products that vary on explicitly defined, specific dimensions only (so it defines both a set of variants, as well as which values distinguish amongst those variants). When used with \[\[ProductGroup\]\], this property can apply to any \[\[Product\]\] included in the group.
     *
     * @see https://schema.org/isVariantOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\ProductGroup')]
    #[ApiProperty(types: ['https://schema.org/isVariantOf'])]
    private ?ProductGroup $isVariantOf = null;

    /**
     * @var Collection<Demand>|null An offer to provide this item—for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use \[\[businessFunction\]\] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a \[\[Demand\]\]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
     *
     * @see https://schema.org/offers
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\Demand')]
    #[ORM\JoinTable(name: 'product_demand_offers')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/offers'])]
    private ?Collection $offers = null;

    /**
     * A \[\[Grant\]\] that directly or indirectly provide funding or sponsorship for this item. See also \[\[ownershipFundingInfo\]\].
     *
     * @see https://schema.org/funding
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Grant')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/funding'])]
    #[Assert\NotNull]
    private Grant $funding;

    public function __construct()
    {
        $this->sku = new ArrayCollection();
        $this->isSimilarTo = new ArrayCollection();
        $this->gtin8 = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->isConsumableFor = new ArrayCollection();
        $this->gtin13 = new ArrayCollection();
        $this->gtin14 = new ArrayCollection();
        $this->mpn = new ArrayCollection();
        $this->brand = new ArrayCollection();
        $this->isAccessoryOrSparePartFor = new ArrayCollection();
        $this->offers = new ArrayCollection();
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

    public function setNegativeNotes(ItemList $negativeNotes): void
    {
        $this->negativeNotes = $negativeNotes;
    }

    public function getNegativeNotes(): ItemList
    {
        return $this->negativeNotes;
    }

    public function setIsRelatedTo(?Product $isRelatedTo): void
    {
        $this->isRelatedTo = $isRelatedTo;
    }

    public function getIsRelatedTo(): ?Product
    {
        return $this->isRelatedTo;
    }

    public function setManufacturer(?Organization $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    public function getManufacturer(): ?Organization
    {
        return $this->manufacturer;
    }

    public function addIsSimilarTo(Product $isSimilarTo): void
    {
        $this->isSimilarTo[] = $isSimilarTo;
    }

    public function removeIsSimilarTo(Product $isSimilarTo): void
    {
        $this->isSimilarTo->removeElement($isSimilarTo);
    }

    /**
     * @return Collection<Product>|null
     */
    public function getIsSimilarTo(): Collection
    {
        return $this->isSimilarTo;
    }

    public function setSize(?string $size): void
    {
        $this->size = $size;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setHasCertification(Certification $hasCertification): void
    {
        $this->hasCertification = $hasCertification;
    }

    public function getHasCertification(): Certification
    {
        return $this->hasCertification;
    }

    public function setHasEnergyConsumptionDetails(EnergyConsumptionDetails $hasEnergyConsumptionDetails): void
    {
        $this->hasEnergyConsumptionDetails = $hasEnergyConsumptionDetails;
    }

    public function getHasEnergyConsumptionDetails(): EnergyConsumptionDetails
    {
        return $this->hasEnergyConsumptionDetails;
    }

    public function setHasMeasurement(QuantitativeValue $hasMeasurement): void
    {
        $this->hasMeasurement = $hasMeasurement;
    }

    public function getHasMeasurement(): QuantitativeValue
    {
        return $this->hasMeasurement;
    }

    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
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

    public function setWeight(?QuantitativeValue $weight): void
    {
        $this->weight = $weight;
    }

    public function getWeight(): ?QuantitativeValue
    {
        return $this->weight;
    }

    public function setAdditionalProperty(PropertyValue $additionalProperty): void
    {
        $this->additionalProperty = $additionalProperty;
    }

    public function getAdditionalProperty(): PropertyValue
    {
        return $this->additionalProperty;
    }

    public function setCountryOfLastProcessing(?string $countryOfLastProcessing): void
    {
        $this->countryOfLastProcessing = $countryOfLastProcessing;
    }

    public function getCountryOfLastProcessing(): ?string
    {
        return $this->countryOfLastProcessing;
    }

    public function setItemCondition(string $itemCondition): void
    {
        $this->itemCondition = $itemCondition;
    }

    public function getItemCondition(): string
    {
        return $this->itemCondition;
    }

    public function setModel(?ProductModel $model): void
    {
        $this->model = $model;
    }

    public function getModel(): ?ProductModel
    {
        return $this->model;
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

    public function setWidth(?QuantitativeValue $width): void
    {
        $this->width = $width;
    }

    public function getWidth(): ?QuantitativeValue
    {
        return $this->width;
    }

    public function setInProductGroupWithID(?string $inProductGroupWithID): void
    {
        $this->inProductGroupWithID = $inProductGroupWithID;
    }

    public function getInProductGroupWithID(): ?string
    {
        return $this->inProductGroupWithID;
    }

    public function setAggregateRating(?AggregateRating $aggregateRating): void
    {
        $this->aggregateRating = $aggregateRating;
    }

    public function getAggregateRating(): ?AggregateRating
    {
        return $this->aggregateRating;
    }

    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setAsin(?string $asin): void
    {
        $this->asin = $asin;
    }

    public function getAsin(): ?string
    {
        return $this->asin;
    }

    public function setPositiveNotes(ItemList $positiveNotes): void
    {
        $this->positiveNotes = $positiveNotes;
    }

    public function getPositiveNotes(): ItemList
    {
        return $this->positiveNotes;
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

    public function setNsn(?string $nsn): void
    {
        $this->nsn = $nsn;
    }

    public function getNsn(): ?string
    {
        return $this->nsn;
    }

    public function setProductionDate(?\DateTimeInterface $productionDate): void
    {
        $this->productionDate = $productionDate;
    }

    public function getProductionDate(): ?\DateTimeInterface
    {
        return $this->productionDate;
    }

    public function setCountryOfOrigin(?Country $countryOfOrigin): void
    {
        $this->countryOfOrigin = $countryOfOrigin;
    }

    public function getCountryOfOrigin(): ?Country
    {
        return $this->countryOfOrigin;
    }

    public function setMobileUrl(?string $mobileUrl): void
    {
        $this->mobileUrl = $mobileUrl;
    }

    public function getMobileUrl(): ?string
    {
        return $this->mobileUrl;
    }

    public function setAward(?string $award): void
    {
        $this->award = $award;
    }

    public function getAward(): ?string
    {
        return $this->award;
    }

    public function setProductID(?string $productID): void
    {
        $this->productID = $productID;
    }

    public function getProductID(): ?string
    {
        return $this->productID;
    }

    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setPurchaseDate(?\DateTimeInterface $purchaseDate): void
    {
        $this->purchaseDate = $purchaseDate;
    }

    public function getPurchaseDate(): ?\DateTimeInterface
    {
        return $this->purchaseDate;
    }

    public function addIsConsumableFor(Product $isConsumableFor): void
    {
        $this->isConsumableFor[] = $isConsumableFor;
    }

    public function removeIsConsumableFor(Product $isConsumableFor): void
    {
        $this->isConsumableFor->removeElement($isConsumableFor);
    }

    /**
     * @return Collection<Product>|null
     */
    public function getIsConsumableFor(): Collection
    {
        return $this->isConsumableFor;
    }

    public function setPattern(DefinedTerm $pattern): void
    {
        $this->pattern = $pattern;
    }

    public function getPattern(): DefinedTerm
    {
        return $this->pattern;
    }

    public function setMaterial(?string $material): void
    {
        $this->material = $material;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
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

    public function setSlogan(?string $slogan): void
    {
        $this->slogan = $slogan;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
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

    public function setIsFamilyFriendly(?bool $isFamilyFriendly): void
    {
        $this->isFamilyFriendly = $isFamilyFriendly;
    }

    public function getIsFamilyFriendly(): ?bool
    {
        return $this->isFamilyFriendly;
    }

    public function setCountryOfAssembly(?string $countryOfAssembly): void
    {
        $this->countryOfAssembly = $countryOfAssembly;
    }

    public function getCountryOfAssembly(): ?string
    {
        return $this->countryOfAssembly;
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

    public function addBrand(Organization $brand): void
    {
        $this->brand[] = $brand;
    }

    public function removeBrand(Organization $brand): void
    {
        $this->brand->removeElement($brand);
    }

    /**
     * @return Collection<Organization>|null
     */
    public function getBrand(): Collection
    {
        return $this->brand;
    }

    public function setAudience(Audience $audience): void
    {
        $this->audience = $audience;
    }

    public function getAudience(): Audience
    {
        return $this->audience;
    }

    public function addIsAccessoryOrSparePartFor(Product $isAccessoryOrSparePartFor): void
    {
        $this->isAccessoryOrSparePartFor[] = $isAccessoryOrSparePartFor;
    }

    public function removeIsAccessoryOrSparePartFor(Product $isAccessoryOrSparePartFor): void
    {
        $this->isAccessoryOrSparePartFor->removeElement($isAccessoryOrSparePartFor);
    }

    /**
     * @return Collection<Product>|null
     */
    public function getIsAccessoryOrSparePartFor(): Collection
    {
        return $this->isAccessoryOrSparePartFor;
    }

    public function setHeight(?QuantitativeValue $height): void
    {
        $this->height = $height;
    }

    public function getHeight(): ?QuantitativeValue
    {
        return $this->height;
    }

    public function setColorSwatch(?string $colorSwatch): void
    {
        $this->colorSwatch = $colorSwatch;
    }

    public function getColorSwatch(): ?string
    {
        return $this->colorSwatch;
    }

    public function setHasMerchantReturnPolicy(MerchantReturnPolicy $hasMerchantReturnPolicy): void
    {
        $this->hasMerchantReturnPolicy = $hasMerchantReturnPolicy;
    }

    public function getHasMerchantReturnPolicy(): MerchantReturnPolicy
    {
        return $this->hasMerchantReturnPolicy;
    }

    public function setDepth(?QuantitativeValue $depth): void
    {
        $this->depth = $depth;
    }

    public function getDepth(): ?QuantitativeValue
    {
        return $this->depth;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setIsVariantOf(?ProductGroup $isVariantOf): void
    {
        $this->isVariantOf = $isVariantOf;
    }

    public function getIsVariantOf(): ?ProductGroup
    {
        return $this->isVariantOf;
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

    public function setFunding(Grant $funding): void
    {
        $this->funding = $funding;
    }

    public function getFunding(): Grant
    {
        return $this->funding;
    }
}

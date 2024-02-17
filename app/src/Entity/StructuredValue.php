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
 * Structured values are used when the value of a property has a more complex structure than simply being a textual value or a reference to another thing.
 *
 * @see https://schema.org/StructuredValue
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'structuredValue' => StructuredValue::class,
	'shippingRateSettings' => ShippingRateSettings::class,
	'shippingDeliveryTime' => ShippingDeliveryTime::class,
	'nutritionInformation' => NutritionInformation::class,
	'warrantyPromise' => WarrantyPromise::class,
	'postalCodeRangeSpecification' => PostalCodeRangeSpecification::class,
	'repaymentSpecification' => RepaymentSpecification::class,
	'openingHoursSpecification' => OpeningHoursSpecification::class,
	'ownershipInfo' => OwnershipInfo::class,
	'typeAndQuantityNode' => TypeAndQuantityNode::class,
	'contactPoint' => ContactPoint::class,
	'interactionCounter' => InteractionCounter::class,
	'engineSpecification' => EngineSpecification::class,
	'geoShape' => GeoShape::class,
	'monetaryAmount' => MonetaryAmount::class,
	'exchangeRateSpecification' => ExchangeRateSpecification::class,
	'datedMoneySpecification' => DatedMoneySpecification::class,
	'propertyValue' => PropertyValue::class,
	'definedRegion' => DefinedRegion::class,
	'deliveryTimeSettings' => DeliveryTimeSettings::class,
	'CDCPMDRecord' => CDCPMDRecord::class,
	'geoCoordinates' => GeoCoordinates::class,
	'offerShippingDetails' => OfferShippingDetails::class,
	'quantitativeValue' => QuantitativeValue::class,
	'priceSpecification' => PriceSpecification::class,
	'monetaryAmountDistribution' => MonetaryAmountDistribution::class,
	'postalAddress' => PostalAddress::class,
	'geoCircle' => GeoCircle::class,
	'locationFeatureSpecification' => LocationFeatureSpecification::class,
	'observation' => Observation::class,
	'deliveryChargeSpecification' => DeliveryChargeSpecification::class,
	'compoundPriceSpecification' => CompoundPriceSpecification::class,
	'unitPriceSpecification' => UnitPriceSpecification::class,
	'paymentChargeSpecification' => PaymentChargeSpecification::class,
])]
class StructuredValue extends Intangible
{
}

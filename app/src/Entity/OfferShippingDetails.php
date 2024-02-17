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
 * OfferShippingDetails represents information about shipping destinations. Multiple of these entities can be used to represent different shipping rates for different destinations: One entity for Alaska/Hawaii. A different one for continental US. A different one for all France. Multiple of these entities can be used to represent different shipping costs and delivery times. Two entities that are identical but differ in rate and time: E.g. Cheaper and slower: $5 in 5-7 days or Fast and expensive: $15 in 1-2 days.
 *
 * @see https://schema.org/OfferShippingDetails
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OfferShippingDetails'])]
class OfferShippingDetails extends StructuredValue
{
	/**
	 * Label to match an \[\[OfferShippingDetails\]\] with a \[\[ShippingRateSettings\]\] (within the context of a \[\[shippingSettingsLink\]\] cross-reference).
	 *
	 * @see https://schema.org/shippingLabel
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/shippingLabel'])]
	private ?string $shippingLabel = null;

	/**
	 * Link to a page containing \[\[ShippingRateSettings\]\] and \[\[DeliveryTimeSettings\]\] details.
	 *
	 * @see https://schema.org/shippingSettingsLink
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/shippingSettingsLink'])]
	#[Assert\Url]
	private ?string $shippingSettingsLink = null;

	/**
	 * The weight of the product or person.
	 *
	 * @see https://schema.org/weight
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/weight'])]
	private ?QuantitativeValue $weight = null;

	/**
	 * Indicates when shipping to a particular \[\[shippingDestination\]\] is not available.
	 *
	 * @see https://schema.org/doesNotShip
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/doesNotShip'])]
	private ?bool $doesNotShip = null;

	/**
	 * Label to match an \[\[OfferShippingDetails\]\] with a \[\[DeliveryTimeSettings\]\] (within the context of a \[\[shippingSettingsLink\]\] cross-reference).
	 *
	 * @see https://schema.org/transitTimeLabel
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/transitTimeLabel'])]
	private ?string $transitTimeLabel = null;

	/**
	 * The width of the item.
	 *
	 * @see https://schema.org/width
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/width'])]
	private ?QuantitativeValue $width = null;

	/**
	 * The shipping rate is the cost of shipping to the specified destination. Typically, the maxValue and currency values (of the \[\[MonetaryAmount\]\]) are most appropriate.
	 *
	 * @see https://schema.org/shippingRate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
	#[ApiProperty(types: ['https://schema.org/shippingRate'])]
	private ?MonetaryAmount $shippingRate = null;

	/**
	 * The total delay between the receipt of the order and the goods reaching the final customer.
	 *
	 * @see https://schema.org/deliveryTime
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\ShippingDeliveryTime')]
	#[ApiProperty(types: ['https://schema.org/deliveryTime'])]
	private ?ShippingDeliveryTime $deliveryTime = null;

	/**
	 * indicates (possibly multiple) shipping destinations. These can be defined in several ways, e.g. postalCode ranges.
	 *
	 * @see https://schema.org/shippingDestination
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedRegion')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/shippingDestination'])]
	#[Assert\NotNull]
	private DefinedRegion $shippingDestination;

	/**
	 * Indicates the origin of a shipment, i.e. where it should be coming from.
	 *
	 * @see https://schema.org/shippingOrigin
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedRegion')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/shippingOrigin'])]
	#[Assert\NotNull]
	private DefinedRegion $shippingOrigin;

	/**
	 * The height of the item.
	 *
	 * @see https://schema.org/height
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/height'])]
	private ?QuantitativeValue $height = null;

	/**
	 * The depth of the item.
	 *
	 * @see https://schema.org/depth
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/depth'])]
	private ?QuantitativeValue $depth = null;

	public function setShippingLabel(?string $shippingLabel): void
	{
		$this->shippingLabel = $shippingLabel;
	}

	public function getShippingLabel(): ?string
	{
		return $this->shippingLabel;
	}

	public function setShippingSettingsLink(?string $shippingSettingsLink): void
	{
		$this->shippingSettingsLink = $shippingSettingsLink;
	}

	public function getShippingSettingsLink(): ?string
	{
		return $this->shippingSettingsLink;
	}

	public function setWeight(?QuantitativeValue $weight): void
	{
		$this->weight = $weight;
	}

	public function getWeight(): ?QuantitativeValue
	{
		return $this->weight;
	}

	public function setDoesNotShip(?bool $doesNotShip): void
	{
		$this->doesNotShip = $doesNotShip;
	}

	public function getDoesNotShip(): ?bool
	{
		return $this->doesNotShip;
	}

	public function setTransitTimeLabel(?string $transitTimeLabel): void
	{
		$this->transitTimeLabel = $transitTimeLabel;
	}

	public function getTransitTimeLabel(): ?string
	{
		return $this->transitTimeLabel;
	}

	public function setWidth(?QuantitativeValue $width): void
	{
		$this->width = $width;
	}

	public function getWidth(): ?QuantitativeValue
	{
		return $this->width;
	}

	public function setShippingRate(?MonetaryAmount $shippingRate): void
	{
		$this->shippingRate = $shippingRate;
	}

	public function getShippingRate(): ?MonetaryAmount
	{
		return $this->shippingRate;
	}

	public function setDeliveryTime(?ShippingDeliveryTime $deliveryTime): void
	{
		$this->deliveryTime = $deliveryTime;
	}

	public function getDeliveryTime(): ?ShippingDeliveryTime
	{
		return $this->deliveryTime;
	}

	public function setShippingDestination(DefinedRegion $shippingDestination): void
	{
		$this->shippingDestination = $shippingDestination;
	}

	public function getShippingDestination(): DefinedRegion
	{
		return $this->shippingDestination;
	}

	public function setShippingOrigin(DefinedRegion $shippingOrigin): void
	{
		$this->shippingOrigin = $shippingOrigin;
	}

	public function getShippingOrigin(): DefinedRegion
	{
		return $this->shippingOrigin;
	}

	public function setHeight(?QuantitativeValue $height): void
	{
		$this->height = $height;
	}

	public function getHeight(): ?QuantitativeValue
	{
		return $this->height;
	}

	public function setDepth(?QuantitativeValue $depth): void
	{
		$this->depth = $depth;
	}

	public function getDepth(): ?QuantitativeValue
	{
		return $this->depth;
	}
}

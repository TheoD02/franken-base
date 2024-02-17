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
 * A DeliveryTimeSettings represents re-usable pieces of shipping information, relating to timing. It is designed for publication on an URL that may be referenced via the \[\[shippingSettingsLink\]\] property of an \[\[OfferShippingDetails\]\]. Several occurrences can be published, distinguished (and identified/referenced) by their different values for \[\[transitTimeLabel\]\].
 *
 * @see https://schema.org/DeliveryTimeSettings
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DeliveryTimeSettings'])]
class DeliveryTimeSettings extends StructuredValue
{
	/**
	 * Label to match an \[\[OfferShippingDetails\]\] with a \[\[DeliveryTimeSettings\]\] (within the context of a \[\[shippingSettingsLink\]\] cross-reference).
	 *
	 * @see https://schema.org/transitTimeLabel
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/transitTimeLabel'])]
	private ?string $transitTimeLabel = null;

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
	 * This can be marked 'true' to indicate that some published \[\[DeliveryTimeSettings\]\] or \[\[ShippingRateSettings\]\] are intended to apply to all \[\[OfferShippingDetails\]\] published by the same merchant, when referenced by a \[\[shippingSettingsLink\]\] in those settings. It is not meaningful to use a 'true' value for this property alongside a transitTimeLabel (for \[\[DeliveryTimeSettings\]\]) or shippingLabel (for \[\[ShippingRateSettings\]\]), since this property is for use with unlabelled settings.
	 *
	 * @see https://schema.org/isUnlabelledFallback
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/isUnlabelledFallback'])]
	private ?bool $isUnlabelledFallback = null;

	public function setTransitTimeLabel(?string $transitTimeLabel): void
	{
		$this->transitTimeLabel = $transitTimeLabel;
	}

	public function getTransitTimeLabel(): ?string
	{
		return $this->transitTimeLabel;
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

	public function setIsUnlabelledFallback(?bool $isUnlabelledFallback): void
	{
		$this->isUnlabelledFallback = $isUnlabelledFallback;
	}

	public function getIsUnlabelledFallback(): ?bool
	{
		return $this->isUnlabelledFallback;
	}
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A ShippingRateSettings represents re-usable pieces of shipping information. It is designed for publication on an URL that may be referenced via the \[\[shippingSettingsLink\]\] property of an \[\[OfferShippingDetails\]\]. Several occurrences can be published, distinguished and matched (i.e. identified/referenced) by their different values for \[\[shippingLabel\]\].
 *
 * @see https://schema.org/ShippingRateSettings
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ShippingRateSettings'])]
class ShippingRateSettings extends StructuredValue
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
     * Indicates when shipping to a particular \[\[shippingDestination\]\] is not available.
     *
     * @see https://schema.org/doesNotShip
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/doesNotShip'])]
    private ?bool $doesNotShip = null;

    /**
     * The shipping rate is the cost of shipping to the specified destination. Typically, the maxValue and currency values (of the \[\[MonetaryAmount\]\]) are most appropriate.
     *
     * @see https://schema.org/shippingRate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/shippingRate'])]
    private ?MonetaryAmount $shippingRate = null;

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
     * A monetary value above (or at) which the shipping rate becomes free. Intended to be used via an \[\[OfferShippingDetails\]\] with \[\[shippingSettingsLink\]\] matching this \[\[ShippingRateSettings\]\].
     *
     * @see https://schema.org/freeShippingThreshold
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/freeShippingThreshold'])]
    #[Assert\NotNull]
    private MonetaryAmount $freeShippingThreshold;

    /**
     * This can be marked 'true' to indicate that some published \[\[DeliveryTimeSettings\]\] or \[\[ShippingRateSettings\]\] are intended to apply to all \[\[OfferShippingDetails\]\] published by the same merchant, when referenced by a \[\[shippingSettingsLink\]\] in those settings. It is not meaningful to use a 'true' value for this property alongside a transitTimeLabel (for \[\[DeliveryTimeSettings\]\]) or shippingLabel (for \[\[ShippingRateSettings\]\]), since this property is for use with unlabelled settings.
     *
     * @see https://schema.org/isUnlabelledFallback
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/isUnlabelledFallback'])]
    private ?bool $isUnlabelledFallback = null;

    public function setShippingLabel(?string $shippingLabel): void
    {
        $this->shippingLabel = $shippingLabel;
    }

    public function getShippingLabel(): ?string
    {
        return $this->shippingLabel;
    }

    public function setDoesNotShip(?bool $doesNotShip): void
    {
        $this->doesNotShip = $doesNotShip;
    }

    public function getDoesNotShip(): ?bool
    {
        return $this->doesNotShip;
    }

    public function setShippingRate(?MonetaryAmount $shippingRate): void
    {
        $this->shippingRate = $shippingRate;
    }

    public function getShippingRate(): ?MonetaryAmount
    {
        return $this->shippingRate;
    }

    public function setShippingDestination(DefinedRegion $shippingDestination): void
    {
        $this->shippingDestination = $shippingDestination;
    }

    public function getShippingDestination(): DefinedRegion
    {
        return $this->shippingDestination;
    }

    public function setFreeShippingThreshold(MonetaryAmount $freeShippingThreshold): void
    {
        $this->freeShippingThreshold = $freeShippingThreshold;
    }

    public function getFreeShippingThreshold(): MonetaryAmount
    {
        return $this->freeShippingThreshold;
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

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ShippingDeliveryTime provides various pieces of information about delivery times for shipping.
 *
 * @see https://schema.org/ShippingDeliveryTime
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ShippingDeliveryTime'])]
class ShippingDeliveryTime extends StructuredValue
{
    /**
     * Order cutoff time allows merchants to describe the time after which they will no longer process orders received on that day. For orders processed after cutoff time, one day gets added to the delivery time estimate. This property is expected to be most typically used via the \[\[ShippingRateSettings\]\] publication pattern. The time is indicated using the ISO-8601 Time format, e.g. "23:30:00-05:00" would represent 6:30 pm Eastern Standard Time (EST) which is 5 hours behind Coordinated Universal Time (UTC).
     *
     * @see https://schema.org/cutoffTime
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Time')]
    #[ApiProperty(types: ['https://schema.org/cutoffTime'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $cutoffTime = null;

    /**
     * The typical delay between the receipt of the order and the goods either leaving the warehouse or being prepared for pickup, in case the delivery method is on site pickup. Typical properties: minValue, maxValue, unitCode (d for DAY). This is by common convention assumed to mean business days (if a unitCode is used, coded as "d"), i.e. only counting days when the business normally operates.
     *
     * @see https://schema.org/handlingTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/handlingTime'])]
    private ?QuantitativeValue $handlingTime = null;

    /**
     * Days of the week when the merchant typically operates, indicated via opening hours markup.
     *
     * @see https://schema.org/businessDays
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\OpeningHoursSpecification')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/businessDays'])]
    #[Assert\NotNull]
    private OpeningHoursSpecification $businessDays;

    /**
     * The typical delay the order has been sent for delivery and the goods reach the final customer. Typical properties: minValue, maxValue, unitCode (d for DAY).
     *
     * @see https://schema.org/transitTime
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/transitTime'])]
    private ?QuantitativeValue $transitTime = null;

    public function setCutoffTime(?\DateTimeInterface $cutoffTime): void
    {
        $this->cutoffTime = $cutoffTime;
    }

    public function getCutoffTime(): ?\DateTimeInterface
    {
        return $this->cutoffTime;
    }

    public function setHandlingTime(?QuantitativeValue $handlingTime): void
    {
        $this->handlingTime = $handlingTime;
    }

    public function getHandlingTime(): ?QuantitativeValue
    {
        return $this->handlingTime;
    }

    public function setBusinessDays(OpeningHoursSpecification $businessDays): void
    {
        $this->businessDays = $businessDays;
    }

    public function getBusinessDays(): OpeningHoursSpecification
    {
        return $this->businessDays;
    }

    public function setTransitTime(?QuantitativeValue $transitTime): void
    {
        $this->transitTime = $transitTime;
    }

    public function getTransitTime(): ?QuantitativeValue
    {
        return $this->transitTime;
    }
}

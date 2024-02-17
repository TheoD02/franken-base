<?php

declare(strict_types=1);

namespace App\Enum;

use ApiPlatform\Metadata\ApiProperty;
use MyCLabs\Enum\Enum;

/**
 * Size related properties of a product, typically a size code (\[\[name\]\]) and optionally a \[\[sizeSystem\]\], \[\[sizeGroup\]\], and product measurements (\[\[hasMeasurement\]\]). In addition, the intended audience can be defined through \[\[suggestedAge\]\], \[\[suggestedGender\]\], and suggested body measurements (\[\[suggestedMeasurement\]\]).
 *
 * @see https://schema.org/SizeSpecification
 */
class SizeSpecification extends Enum
{
    /**
     * A suggested range of body measurements for the intended audience or person, for example inseam between 32 and 34 inches or height between 170 and 190 cm. Typically found on a size chart for wearable products.
     *
     * @see https://schema.org/suggestedMeasurement
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/suggestedMeasurement'])]
    #[Assert\NotNull]
    private QuantitativeValue $suggestedMeasurement;

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
     * The size system used to identify a product's size. Typically either a standard (for example, "GS1" or "ISO-EN13402"), country code (for example "US" or "JP"), or a measuring system (for example "Metric" or "Imperial").
     *
     * @see https://schema.org/sizeSystem
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/sizeSystem'])]
    private ?string $sizeSystem = null;

    /**
     * The size group (also known as "size type") for a product's size. Size groups are common in the fashion industry to define size segments and suggested audiences for wearable products. Multiple values can be combined, for example "men's big and tall", "petite maternity" or "regular".
     *
     * @see https://schema.org/sizeGroup
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/sizeGroup'])]
    private ?string $sizeGroup = null;

    /**
     * The age or age range for the intended audience or person, for example 3-12 months for infants, 1-5 years for toddlers.
     *
     * @see https://schema.org/suggestedAge
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/suggestedAge'])]
    private ?QuantitativeValue $suggestedAge = null;

    /**
     * The suggested gender of the intended person or audience, for example "male", "female", or "unisex".
     *
     * @see https://schema.org/suggestedGender
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/suggestedGender'])]
    #[Assert\Choice(callback: [GenderType::class, 'toArray'])]
    private ?string $suggestedGender = null;

    public function setSuggestedMeasurement(QuantitativeValue $suggestedMeasurement): void
    {
        $this->suggestedMeasurement = $suggestedMeasurement;
    }

    public function getSuggestedMeasurement(): QuantitativeValue
    {
        return $this->suggestedMeasurement;
    }

    public function setHasMeasurement(QuantitativeValue $hasMeasurement): void
    {
        $this->hasMeasurement = $hasMeasurement;
    }

    public function getHasMeasurement(): QuantitativeValue
    {
        return $this->hasMeasurement;
    }

    public function setSizeSystem(?string $sizeSystem): void
    {
        $this->sizeSystem = $sizeSystem;
    }

    public function getSizeSystem(): ?string
    {
        return $this->sizeSystem;
    }

    public function setSizeGroup(?string $sizeGroup): void
    {
        $this->sizeGroup = $sizeGroup;
    }

    public function getSizeGroup(): ?string
    {
        return $this->sizeGroup;
    }

    public function setSuggestedAge(?QuantitativeValue $suggestedAge): void
    {
        $this->suggestedAge = $suggestedAge;
    }

    public function getSuggestedAge(): ?QuantitativeValue
    {
        return $this->suggestedAge;
    }

    public function setSuggestedGender(?string $suggestedGender): void
    {
        $this->suggestedGender = $suggestedGender;
    }

    public function getSuggestedGender(): ?string
    {
        return $this->suggestedGender;
    }
}

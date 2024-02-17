<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Property value specification.
 *
 * @see https://schema.org/PropertyValueSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PropertyValueSpecification'])]
class PropertyValueSpecification extends Intangible
{
    /**
     * The stepValue attribute indicates the granularity that is expected (and required) of the value in a PropertyValueSpecification.
     *
     * @see https://schema.org/stepValue
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/stepValue'])]
    private ?string $stepValue = null;

    /**
     * Specifies the allowed range for number of characters in a literal value.
     *
     * @see https://schema.org/valueMaxLength
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/valueMaxLength'])]
    private ?string $valueMaxLength = null;

    /**
     * Whether or not a property is mutable. Default is false. Specifying this for a property that also has a value makes it act similar to a "hidden" input in an HTML form.
     *
     * @see https://schema.org/readonlyValue
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/readonlyValue'])]
    private ?bool $readonlyValue = null;

    /**
     * Whether the property must be filled in to complete the action. Default is false.
     *
     * @see https://schema.org/valueRequired
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/valueRequired'])]
    private ?bool $valueRequired = null;

    /**
     * Whether multiple values are allowed for the property. Default is false.
     *
     * @see https://schema.org/multipleValues
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/multipleValues'])]
    private ?bool $multipleValues = null;

    /**
     * Indicates the name of the PropertyValueSpecification to be used in URL templates and form encoding in a manner analogous to HTML's input\@name.
     *
     * @see https://schema.org/valueName
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/valueName'])]
    private ?string $valueName = null;

    /**
     * The upper value of some characteristic or property.
     *
     * @see https://schema.org/maxValue
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/maxValue'])]
    private ?string $maxValue = null;

    /**
     * The lower value of some characteristic or property.
     *
     * @see https://schema.org/minValue
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/minValue'])]
    private ?string $minValue = null;

    /**
     * Specifies a regular expression for testing literal values according to the HTML spec.
     *
     * @see https://schema.org/valuePattern
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/valuePattern'])]
    private ?string $valuePattern = null;

    /**
     * The default value of the input. For properties that expect a literal, the default is a literal value, for properties that expect an object, it's an ID reference to one of the current values.
     *
     * @see https://schema.org/defaultValue
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ApiProperty(types: ['https://schema.org/defaultValue'])]
    private ?Thing $defaultValue = null;

    /**
     * Specifies the minimum allowed range for number of characters in a literal value.
     *
     * @see https://schema.org/valueMinLength
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/valueMinLength'])]
    private ?string $valueMinLength = null;

    public function setStepValue(?string $stepValue): void
    {
        $this->stepValue = $stepValue;
    }

    public function getStepValue(): ?string
    {
        return $this->stepValue;
    }

    public function setValueMaxLength(?string $valueMaxLength): void
    {
        $this->valueMaxLength = $valueMaxLength;
    }

    public function getValueMaxLength(): ?string
    {
        return $this->valueMaxLength;
    }

    public function setReadonlyValue(?bool $readonlyValue): void
    {
        $this->readonlyValue = $readonlyValue;
    }

    public function getReadonlyValue(): ?bool
    {
        return $this->readonlyValue;
    }

    public function setValueRequired(?bool $valueRequired): void
    {
        $this->valueRequired = $valueRequired;
    }

    public function getValueRequired(): ?bool
    {
        return $this->valueRequired;
    }

    public function setMultipleValues(?bool $multipleValues): void
    {
        $this->multipleValues = $multipleValues;
    }

    public function getMultipleValues(): ?bool
    {
        return $this->multipleValues;
    }

    public function setValueName(?string $valueName): void
    {
        $this->valueName = $valueName;
    }

    public function getValueName(): ?string
    {
        return $this->valueName;
    }

    public function setMaxValue(?string $maxValue): void
    {
        $this->maxValue = $maxValue;
    }

    public function getMaxValue(): ?string
    {
        return $this->maxValue;
    }

    public function setMinValue(?string $minValue): void
    {
        $this->minValue = $minValue;
    }

    public function getMinValue(): ?string
    {
        return $this->minValue;
    }

    public function setValuePattern(?string $valuePattern): void
    {
        $this->valuePattern = $valuePattern;
    }

    public function getValuePattern(): ?string
    {
        return $this->valuePattern;
    }

    public function setDefaultValue(?Thing $defaultValue): void
    {
        $this->defaultValue = $defaultValue;
    }

    public function getDefaultValue(): ?Thing
    {
        return $this->defaultValue;
    }

    public function setValueMinLength(?string $valueMinLength): void
    {
        $this->valueMinLength = $valueMinLength;
    }

    public function getValueMinLength(): ?string
    {
        return $this->valueMinLength;
    }
}

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
use App\Enum\QualitativeValue;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A point value or interval for product characteristics and other purposes.
 *
 * @see https://schema.org/QuantitativeValue
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['quantitativeValue' => QuantitativeValue::class, 'observation' => Observation::class])]
class QuantitativeValue extends StructuredValue
{
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
	 * @var string[]|null A secondary value that provides additional information on the original value, e.g. a reference temperature or a type of measurement.
	 * @see https://schema.org/valueReference
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/valueReference'])]
	#[Assert\Choice(callback: [QualitativeValue::class, 'toArray'], multiple: true)]
	private ?Collection $valueReference = null;

	/**
	 * The value of a \[\[QuantitativeValue\]\] (including \[\[Observation\]\]) or property value node.\\n\\n\* For \[\[QuantitativeValue\]\] and \[\[MonetaryAmount\]\], the recommended type for values is 'Number'.\\n\* For \[\[PropertyValue\]\], it can be 'Text', 'Number', 'Boolean', or 'StructuredValue'.\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.
	 *
	 * @see https://schema.org/value
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\StructuredValue')]
	#[ApiProperty(types: ['https://schema.org/value'])]
	private ?StructuredValue $value = null;

	/**
	 * The upper value of some characteristic or property.
	 *
	 * @see https://schema.org/maxValue
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/maxValue'])]
	private ?string $maxValue = null;

	/**
	 * The unit of measurement given using the UN/CEFACT Common Code (3 characters) or a URL. Other codes than the UN/CEFACT Common Code may be used with a prefix followed by a colon.
	 *
	 * @see https://schema.org/unitCode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/unitCode'])]
	#[Assert\NotNull]
	private string $unitCode;

	/**
	 * The lower value of some characteristic or property.
	 *
	 * @see https://schema.org/minValue
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/minValue'])]
	private ?string $minValue = null;

	/**
	 * A string or text indicating the unit of measurement. Useful if you cannot provide a standard unit code for [unitCode](unitCode).
	 *
	 * @see https://schema.org/unitText
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/unitText'])]
	private ?string $unitText = null;

	public function setAdditionalProperty(PropertyValue $additionalProperty): void
	{
		$this->additionalProperty = $additionalProperty;
	}

	public function getAdditionalProperty(): PropertyValue
	{
		return $this->additionalProperty;
	}

	public function addValueReference($valueReference): void
	{
		$this->valueReference[] = (string) $valueReference;
	}

	public function removeValueReference(string $valueReference): void
	{
		if (false !== $key = array_search((string)$valueReference, $this->valueReference ?? [], true)) {
		    unset($this->valueReference[$key]);
		}
	}

	/**
	 * @return string[]|null
	 */
	public function getValueReference(): Collection
	{
		return $this->valueReference;
	}

	public function setValue(?StructuredValue $value): void
	{
		$this->value = $value;
	}

	public function getValue(): ?StructuredValue
	{
		return $this->value;
	}

	public function setMaxValue(?string $maxValue): void
	{
		$this->maxValue = $maxValue;
	}

	public function getMaxValue(): ?string
	{
		return $this->maxValue;
	}

	public function setUnitCode(string $unitCode): void
	{
		$this->unitCode = $unitCode;
	}

	public function getUnitCode(): string
	{
		return $this->unitCode;
	}

	public function setMinValue(?string $minValue): void
	{
		$this->minValue = $minValue;
	}

	public function getMinValue(): ?string
	{
		return $this->minValue;
	}

	public function setUnitText(?string $unitText): void
	{
		$this->unitText = $unitText;
	}

	public function getUnitText(): ?string
	{
		return $this->unitText;
	}
}

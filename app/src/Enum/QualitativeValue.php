<?php

namespace App\Enum;

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
use MyCLabs\Enum\Enum;

/**
 * A predefined value for a product characteristic, e.g. the power cord plug type 'US' or the garment sizes 'S', 'M', 'L', and 'XL'.
 *
 * @see https://schema.org/QualitativeValue
 */
class QualitativeValue extends Enum
{
	/**
	 * @var string[]|null This ordering relation for qualitative values indicates that the subject is greater than or equal to the object.
	 * @see https://schema.org/greaterOrEqual
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/greaterOrEqual'])]
	#[Assert\Choice(callback: [QualitativeValue::class, 'toArray'], multiple: true)]
	private ?Collection $greaterOrEqual = null;

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
	 * @var string[]|null This ordering relation for qualitative values indicates that the subject is lesser than the object.
	 * @see https://schema.org/lesser
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/lesser'])]
	#[Assert\Choice(callback: [QualitativeValue::class, 'toArray'], multiple: true)]
	private ?Collection $lesser = null;

	/**
	 * @var string[]|null A secondary value that provides additional information on the original value, e.g. a reference temperature or a type of measurement.
	 * @see https://schema.org/valueReference
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/valueReference'])]
	#[Assert\Choice(callback: [QualitativeValue::class, 'toArray'], multiple: true)]
	private ?Collection $valueReference = null;

	/**
	 * @var string[]|null This ordering relation for qualitative values indicates that the subject is greater than the object.
	 * @see https://schema.org/greater
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/greater'])]
	#[Assert\Choice(callback: [QualitativeValue::class, 'toArray'], multiple: true)]
	private ?Collection $greater = null;

	/**
	 * @var string[]|null This ordering relation for qualitative values indicates that the subject is equal to the object.
	 * @see https://schema.org/equal
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/equal'])]
	#[Assert\Choice(callback: [QualitativeValue::class, 'toArray'], multiple: true)]
	private ?Collection $equal = null;

	/**
	 * @var string[]|null This ordering relation for qualitative values indicates that the subject is not equal to the object.
	 * @see https://schema.org/nonEqual
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/nonEqual'])]
	#[Assert\Choice(callback: [QualitativeValue::class, 'toArray'], multiple: true)]
	private ?Collection $nonEqual = null;

	/**
	 * @var string[]|null This ordering relation for qualitative values indicates that the subject is lesser than or equal to the object.
	 * @see https://schema.org/lesserOrEqual
	 */
	#[ORM\Column(type: 'simple_array', nullable: true)]
	#[ApiProperty(types: ['https://schema.org/lesserOrEqual'])]
	#[Assert\Choice(callback: [QualitativeValue::class, 'toArray'], multiple: true)]
	private ?Collection $lesserOrEqual = null;

	public function addGreaterOrEqual($greaterOrEqual): void
	{
		$this->greaterOrEqual[] = (string) $greaterOrEqual;
	}

	public function removeGreaterOrEqual(string $greaterOrEqual): void
	{
		if (false !== $key = array_search((string)$greaterOrEqual, $this->greaterOrEqual ?? [], true)) {
		    unset($this->greaterOrEqual[$key]);
		}
	}

	/**
	 * @return string[]|null
	 */
	public function getGreaterOrEqual(): Collection
	{
		return $this->greaterOrEqual;
	}

	public function setAdditionalProperty(PropertyValue $additionalProperty): void
	{
		$this->additionalProperty = $additionalProperty;
	}

	public function getAdditionalProperty(): PropertyValue
	{
		return $this->additionalProperty;
	}

	public function addLesser($lesser): void
	{
		$this->lesser[] = (string) $lesser;
	}

	public function removeLesser(string $lesser): void
	{
		if (false !== $key = array_search((string)$lesser, $this->lesser ?? [], true)) {
		    unset($this->lesser[$key]);
		}
	}

	/**
	 * @return string[]|null
	 */
	public function getLesser(): Collection
	{
		return $this->lesser;
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

	public function addGreater($greater): void
	{
		$this->greater[] = (string) $greater;
	}

	public function removeGreater(string $greater): void
	{
		if (false !== $key = array_search((string)$greater, $this->greater ?? [], true)) {
		    unset($this->greater[$key]);
		}
	}

	/**
	 * @return string[]|null
	 */
	public function getGreater(): Collection
	{
		return $this->greater;
	}

	public function addEqual($equal): void
	{
		$this->equal[] = (string) $equal;
	}

	public function removeEqual(string $equal): void
	{
		if (false !== $key = array_search((string)$equal, $this->equal ?? [], true)) {
		    unset($this->equal[$key]);
		}
	}

	/**
	 * @return string[]|null
	 */
	public function getEqual(): Collection
	{
		return $this->equal;
	}

	public function addNonEqual($nonEqual): void
	{
		$this->nonEqual[] = (string) $nonEqual;
	}

	public function removeNonEqual(string $nonEqual): void
	{
		if (false !== $key = array_search((string)$nonEqual, $this->nonEqual ?? [], true)) {
		    unset($this->nonEqual[$key]);
		}
	}

	/**
	 * @return string[]|null
	 */
	public function getNonEqual(): Collection
	{
		return $this->nonEqual;
	}

	public function addLesserOrEqual($lesserOrEqual): void
	{
		$this->lesserOrEqual[] = (string) $lesserOrEqual;
	}

	public function removeLesserOrEqual(string $lesserOrEqual): void
	{
		if (false !== $key = array_search((string)$lesserOrEqual, $this->lesserOrEqual ?? [], true)) {
		    unset($this->lesserOrEqual[$key]);
		}
	}

	/**
	 * @return string[]|null
	 */
	public function getLesserOrEqual(): Collection
	{
		return $this->lesserOrEqual;
	}
}

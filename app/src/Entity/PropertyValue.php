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
 * A property-value pair, e.g. representing a feature of a product or place. Use the 'name' property for the name of the property. If there is an additional human-readable version of the value, put that into the 'description' property.\\n\\n Always use specific schema.org properties when a) they exist and b) you can populate them. Using PropertyValue as a substitute will typically not trigger the same effect as using the original, specific property.
 *
 * @see https://schema.org/PropertyValue
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['propertyValue' => PropertyValue::class, 'locationFeatureSpecification' => LocationFeatureSpecification::class])]
class PropertyValue extends StructuredValue
{
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
	 * A subproperty of \[\[measurementTechnique\]\] that can be used for specifying specific methods, in particular via \[\[MeasurementMethodEnum\]\].
	 *
	 * @see https://schema.org/measurementMethod
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/measurementMethod'])]
	#[Assert\Url]
	private ?string $measurementMethod = null;

	/**
	 * @var Collection<DefinedTerm>|null A technique, method or technology used in an \[\[Observation\]\], \[\[StatisticalVariable\]\] or \[\[Dataset\]\] (or \[\[DataDownload\]\], \[\[DataCatalog\]\]), corresponding to the method used for measuring the corresponding variable(s) (for datasets, described using \[\[variableMeasured\]\]; for \[\[Observation\]\], a \[\[StatisticalVariable\]\]). Often but not necessarily each \[\[variableMeasured\]\] will have an explicit representation as (or mapping to) an property such as those defined in Schema.org, or other RDF vocabularies and "knowledge graphs". In that case the subproperty of \[\[variableMeasured\]\] called \[\[measuredProperty\]\] is applicable. The \[\[measurementTechnique\]\] property helps when extra clarification is needed about how a \[\[measuredProperty\]\] was measured. This is oriented towards scientific and scholarly dataset publication but may have broader applicability; it is not intended as a full representation of measurement, but can often serve as a high level summary for dataset discovery. For example, if \[\[variableMeasured\]\] is: molecule concentration, \[\[measurementTechnique\]\] could be: "mass spectrometry" or "nmr spectroscopy" or "colorimetry" or "immunofluorescence". If the \[\[variableMeasured\]\] is "depression rating", the \[\[measurementTechnique\]\] could be "Zung Scale" or "HAM-D" or "Beck Depression Inventory". If there are several \[\[variableMeasured\]\] properties recorded for some given data object, use a \[\[PropertyValue\]\] for each \[\[variableMeasured\]\] and attach the corresponding \[\[measurementTechnique\]\]. The value can also be from an enumeration, organized as a \[\[MeasurementMetholdEnumeration\]\].
	 * @see https://schema.org/measurementTechnique
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\DefinedTerm')]
	#[ORM\JoinTable(name: 'property_value_defined_term_measurement_technique')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/measurementTechnique'])]
	private ?Collection $measurementTechnique = null;

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

	/**
	 * A commonly used identifier for the characteristic represented by the property, e.g. a manufacturer or a standard code for a property. propertyID can be (1) a prefixed string, mainly meant to be used with standards for product properties; (2) a site-specific, non-prefixed string (e.g. the primary key of the property or the vendor-specific ID of the property), or (3) a URL indicating the type of the property, either pointing to an external vocabulary, or a Web resource that describes the property (e.g. a glossary entry). Standards bodies should promote a standard prefix for the identifiers of properties from their standards.
	 *
	 * @see https://schema.org/propertyID
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/propertyID'])]
	private ?string $propertyID = null;

	function __construct()
	{
		$this->measurementTechnique = new ArrayCollection();
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

	public function setMeasurementMethod(?string $measurementMethod): void
	{
		$this->measurementMethod = $measurementMethod;
	}

	public function getMeasurementMethod(): ?string
	{
		return $this->measurementMethod;
	}

	public function addMeasurementTechnique(DefinedTerm $measurementTechnique): void
	{
		$this->measurementTechnique[] = $measurementTechnique;
	}

	public function removeMeasurementTechnique(DefinedTerm $measurementTechnique): void
	{
		$this->measurementTechnique->removeElement($measurementTechnique);
	}

	/**
	 * @return Collection<DefinedTerm>|null
	 */
	public function getMeasurementTechnique(): Collection
	{
		return $this->measurementTechnique;
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

	public function setPropertyID(?string $propertyID): void
	{
		$this->propertyID = $propertyID;
	}

	public function getPropertyID(): ?string
	{
		return $this->propertyID;
	}
}

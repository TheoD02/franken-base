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
 * \[\[StatisticalVariable\]\] represents any type of statistical metric that can be measured at a place and time. The usage pattern for \[\[StatisticalVariable\]\] is typically expressed using \[\[Observation\]\] with an explicit \[\[populationType\]\], which is a type, typically drawn from Schema.org. Each \[\[StatisticalVariable\]\] is marked as a \[\[ConstraintNode\]\], meaning that some properties (those listed using \[\[constraintProperty\]\]) serve in this setting solely to define the statistical variable rather than literally describe a specific person, place or thing. For example, a \[\[StatisticalVariable\]\] Median\_Height\_Person\_Female representing the median height of women, could be written as follows: the population type is \[\[Person\]\]; the measuredProperty \[\[height\]\]; the \[\[statType\]\] \[\[median\]\]; the \[\[gender\]\] \[\[Female\]\]. It is important to note that there are many kinds of scientific quantitative observation which are not fully, perfectly or unambiguously described following this pattern, or with solely Schema.org terminology. The approach taken here is designed to allow partial, incremental or minimal description of \[\[StatisticalVariable\]\]s, and the use of detailed sets of entity and property IDs from external repositories. The \[\[measurementMethod\]\], \[\[unitCode\]\] and \[\[unitText\]\] properties can also be used to clarify the specific nature and notation of an observed measurement.
 *
 * @see https://schema.org/StatisticalVariable
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/StatisticalVariable'])]
class StatisticalVariable extends ConstraintNode
{
	/**
	 * The measuredProperty of an \[\[Observation\]\], typically via its \[\[StatisticalVariable\]\]. There are various kinds of applicable \[\[Property\]\]: a schema.org property, a property from other RDF-compatible systems, e.g. W3C RDF Data Cube, Data Commons, Wikidata, or schema.org extensions such as \[GS1's\](https://www.gs1.org/voc/?show=properties).
	 *
	 * @see https://schema.org/measuredProperty
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Property')]
	#[ApiProperty(types: ['https://schema.org/measuredProperty'])]
	private ?Property $measuredProperty = null;

	/**
	 * Identifies the denominator variable when an observation represents a ratio or percentage.
	 *
	 * @see https://schema.org/measurementDenominator
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\StatisticalVariable')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/measurementDenominator'])]
	#[Assert\NotNull]
	private StatisticalVariable $measurementDenominator;

	/**
	 * Indicates the populationType common to all members of a \[\[StatisticalPopulation\]\] or all cases within the scope of a \[\[StatisticalVariable\]\].
	 *
	 * @see https://schema.org/populationType
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Class_')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/populationType'])]
	#[Assert\NotNull]
	private Class_ $populationType;

	/**
	 * Provides additional qualification to an observation. For example, a GDP observation measures the Nominal value.
	 *
	 * @see https://schema.org/measurementQualifier
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Enumeration')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/measurementQualifier'])]
	#[Assert\NotNull]
	private Enumeration $measurementQualifier;

	/**
	 * Indicates the kind of statistic represented by a \[\[StatisticalVariable\]\], e.g. mean, count etc. The value of statType is a property, either from within Schema.org (e.g. \[\[count\]\], \[\[median\]\], \[\[marginOfError\]\], \[\[maxValue\]\], \[\[minValue\]\]) or from other compatible (e.g. RDF) systems such as DataCommons.org or Wikidata.org.
	 *
	 * @see https://schema.org/statType
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/statType'])]
	private ?string $statType = null;

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
	#[ORM\JoinTable(name: 'statistical_variable_defined_term_measurement_technique')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/measurementTechnique'])]
	private ?Collection $measurementTechnique = null;

	function __construct()
	{
		$this->measurementTechnique = new ArrayCollection();
	}

	public function setMeasuredProperty(?Property $measuredProperty): void
	{
		$this->measuredProperty = $measuredProperty;
	}

	public function getMeasuredProperty(): ?Property
	{
		return $this->measuredProperty;
	}

	public function setMeasurementDenominator(StatisticalVariable $measurementDenominator): void
	{
		$this->measurementDenominator = $measurementDenominator;
	}

	public function getMeasurementDenominator(): StatisticalVariable
	{
		return $this->measurementDenominator;
	}

	public function setPopulationType(Class_ $populationType): void
	{
		$this->populationType = $populationType;
	}

	public function getPopulationType(): Class_
	{
		return $this->populationType;
	}

	public function setMeasurementQualifier(Enumeration $measurementQualifier): void
	{
		$this->measurementQualifier = $measurementQualifier;
	}

	public function getMeasurementQualifier(): Enumeration
	{
		return $this->measurementQualifier;
	}

	public function setStatType(?string $statType): void
	{
		$this->statType = $statType;
	}

	public function getStatType(): ?string
	{
		return $this->statType;
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
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Instances of the class \[\[Observation\]\] are used to specify observations about an entity at a particular time. The principal properties of an \[\[Observation\]\] are \[\[observationAbout\]\], \[\[measuredProperty\]\], \[\[statType\]\], \[\[value\] and \[\[observationDate\]\] and \[\[measuredProperty\]\]. Some but not all Observations represent a \[\[QuantitativeValue\]\]. Quantitative observations can be about a \[\[StatisticalVariable\]\], which is an abstract specification about which we can make observations that are grounded at a particular location and time. Observations can also encode a subset of simple RDF-like statements (its observationAbout, a StatisticalVariable, defining the measuredPoperty; its observationAbout property indicating the entity the statement is about, and \[\[value\]\] ) In the context of a quantitative knowledge graph, typical properties could include \[\[measuredProperty\]\], \[\[observationAbout\]\], \[\[observationDate\]\], \[\[value\]\], \[\[unitCode\]\], \[\[unitText\]\], \[\[measurementMethod\]\].
 *
 * @see https://schema.org/Observation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Observation'])]
class Observation extends QuantitativeValue
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
     * A \[\[marginOfError\]\] for an \[\[Observation\]\].
     *
     * @see https://schema.org/marginOfError
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/marginOfError'])]
    #[Assert\NotNull]
    private QuantitativeValue $marginOfError;

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
     * The variableMeasured property can indicate (repeated as necessary) the variables that are measured in some dataset, either described as text or as pairs of identifier and description using PropertyValue, or more explicitly as a \[\[StatisticalVariable\]\].
     *
     * @see https://schema.org/variableMeasured
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/variableMeasured'])]
    private ?string $variableMeasured = null;

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
     * The length of time an Observation took place over. The format follows `P\[0-9\]\*\[Y|M|D|h|m|s\]`. For example, P1Y is Period 1 Year, P3M is Period 3 Months, P3h is Period 3 hours.
     *
     * @see https://schema.org/observationPeriod
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/observationPeriod'])]
    private ?string $observationPeriod = null;

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
     *
     * @see https://schema.org/measurementTechnique
     */
    #[ORM\ManyToMany(targetEntity: 'App\Entity\DefinedTerm')]
    #[ORM\JoinTable(name: 'observation_defined_term_measurement_technique')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/measurementTechnique'])]
    private ?Collection $measurementTechnique = null;

    /**
     * The \[\[observationAbout\]\] property identifies an entity, often a \[\[Place\]\], associated with an \[\[Observation\]\].
     *
     * @see https://schema.org/observationAbout
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Thing')]
    #[ApiProperty(types: ['https://schema.org/observationAbout'])]
    private ?Thing $observationAbout = null;

    /**
     * The observationDate of an \[\[Observation\]\].
     *
     * @see https://schema.org/observationDate
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DateTime')]
    #[ApiProperty(types: ['https://schema.org/observationDate'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $observationDate = null;

    public function __construct()
    {
        parent::__construct();
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

    public function setMarginOfError(QuantitativeValue $marginOfError): void
    {
        $this->marginOfError = $marginOfError;
    }

    public function getMarginOfError(): QuantitativeValue
    {
        return $this->marginOfError;
    }

    public function setMeasurementDenominator(StatisticalVariable $measurementDenominator): void
    {
        $this->measurementDenominator = $measurementDenominator;
    }

    public function getMeasurementDenominator(): StatisticalVariable
    {
        return $this->measurementDenominator;
    }

    public function setVariableMeasured(?string $variableMeasured): void
    {
        $this->variableMeasured = $variableMeasured;
    }

    public function getVariableMeasured(): ?string
    {
        return $this->variableMeasured;
    }

    public function setMeasurementQualifier(Enumeration $measurementQualifier): void
    {
        $this->measurementQualifier = $measurementQualifier;
    }

    public function getMeasurementQualifier(): Enumeration
    {
        return $this->measurementQualifier;
    }

    public function setObservationPeriod(?string $observationPeriod): void
    {
        $this->observationPeriod = $observationPeriod;
    }

    public function getObservationPeriod(): ?string
    {
        return $this->observationPeriod;
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

    public function setObservationAbout(?Thing $observationAbout): void
    {
        $this->observationAbout = $observationAbout;
    }

    public function getObservationAbout(): ?Thing
    {
        return $this->observationAbout;
    }

    public function setObservationDate(?\DateTimeInterface $observationDate): void
    {
        $this->observationDate = $observationDate;
    }

    public function getObservationDate(): ?\DateTimeInterface
    {
        return $this->observationDate;
    }
}

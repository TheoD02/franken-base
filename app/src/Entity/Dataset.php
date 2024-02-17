<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A body of structured information describing some topic(s) of interest.
 *
 * @see https://schema.org/Dataset
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['dataset' => Dataset::class, 'dataFeed' => DataFeed::class, 'completeDataFeed' => CompleteDataFeed::class])]
class Dataset extends CreativeWork
{
    /**
     * A data catalog which contains this dataset.
     *
     * @see https://schema.org/includedInDataCatalog
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DataCatalog')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/includedInDataCatalog'])]
    #[Assert\NotNull]
    private DataCatalog $includedInDataCatalog;

    /**
     * The variableMeasured property can indicate (repeated as necessary) the variables that are measured in some dataset, either described as text or as pairs of identifier and description using PropertyValue, or more explicitly as a \[\[StatisticalVariable\]\].
     *
     * @see https://schema.org/variableMeasured
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/variableMeasured'])]
    private ?string $variableMeasured = null;

    /**
     * The International Standard Serial Number (ISSN) that identifies this serial publication. You can repeat this property to identify different formats of, or the linking ISSN (ISSN-L) for, this serial publication.
     *
     * @see https://schema.org/issn
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/issn'])]
    private ?string $issn = null;

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
    #[ORM\JoinTable(name: 'dataset_defined_term_measurement_technique')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/measurementTechnique'])]
    private ?Collection $measurementTechnique = null;

    /**
     * A downloadable form of this dataset, at a specific location, in a specific format. This property can be repeated if different variations are available. There is no expectation that different downloadable distributions must contain exactly equivalent information (see also \[DCAT\](https://www.w3.org/TR/vocab-dcat-3/#Class:Distribution) on this point). Different distributions might include or exclude different subsets of the entire dataset, for example.
     *
     * @see https://schema.org/distribution
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DataDownload')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/distribution'])]
    #[Assert\NotNull]
    private DataDownload $distribution;

    public function __construct()
    {
        parent::__construct();
        $this->measurementTechnique = new ArrayCollection();
    }

    public function setIncludedInDataCatalog(DataCatalog $includedInDataCatalog): void
    {
        $this->includedInDataCatalog = $includedInDataCatalog;
    }

    public function getIncludedInDataCatalog(): DataCatalog
    {
        return $this->includedInDataCatalog;
    }

    public function setVariableMeasured(?string $variableMeasured): void
    {
        $this->variableMeasured = $variableMeasured;
    }

    public function getVariableMeasured(): ?string
    {
        return $this->variableMeasured;
    }

    public function setIssn(?string $issn): void
    {
        $this->issn = $issn;
    }

    public function getIssn(): ?string
    {
        return $this->issn;
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

    public function setDistribution(DataDownload $distribution): void
    {
        $this->distribution = $distribution;
    }

    public function getDistribution(): DataDownload
    {
        return $this->distribution;
    }
}

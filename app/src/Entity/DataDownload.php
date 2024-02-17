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
 * All or part of a \[\[Dataset\]\] in downloadable form.
 *
 * @see https://schema.org/DataDownload
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DataDownload'])]
class DataDownload extends MediaObject
{
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
    #[ORM\JoinTable(name: 'data_download_defined_term_measurement_technique')]
    #[ORM\InverseJoinColumn(unique: true)]
    #[ApiProperty(types: ['https://schema.org/measurementTechnique'])]
    private ?Collection $measurementTechnique = null;

    public function __construct()
    {
        parent::__construct();
        $this->measurementTechnique = new ArrayCollection();
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

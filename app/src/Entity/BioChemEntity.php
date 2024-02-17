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
 * Any biological, chemical, or biochemical thing. For example: a protein; a gene; a chemical; a synthetic chemical.
 *
 * @see https://schema.org/BioChemEntity
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'bioChemEntity' => BioChemEntity::class,
	'chemicalSubstance' => ChemicalSubstance::class,
	'gene' => Gene::class,
	'protein' => Protein::class,
	'molecularEntity' => MolecularEntity::class,
])]
class BioChemEntity extends Thing
{
	/**
	 * A common representation such as a protein sequence or chemical structure for this entity. For images use schema.org/image.
	 *
	 * @see https://schema.org/hasRepresentation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PropertyValue')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasRepresentation'])]
	#[Assert\NotNull]
	private PropertyValue $hasRepresentation;

	/**
	 * Molecular function performed by this BioChemEntity; please use PropertyValue if you want to include any evidence.
	 *
	 * @see https://schema.org/hasMolecularFunction
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/hasMolecularFunction'])]
	#[Assert\Url]
	private ?string $hasMolecularFunction = null;

	/**
	 * The taxonomic grouping of the organism that expresses, encodes, or in some way related to the BioChemEntity.
	 *
	 * @see https://schema.org/taxonomicRange
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
	#[ApiProperty(types: ['https://schema.org/taxonomicRange'])]
	private ?DefinedTerm $taxonomicRange = null;

	/**
	 * Biological process this BioChemEntity is involved in; please use PropertyValue if you want to include any evidence.
	 *
	 * @see https://schema.org/isInvolvedInBiologicalProcess
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
	#[ApiProperty(types: ['https://schema.org/isInvolvedInBiologicalProcess'])]
	private ?DefinedTerm $isInvolvedInBiologicalProcess = null;

	/**
	 * Subcellular location where this BioChemEntity is located; please use PropertyValue if you want to include any evidence.
	 *
	 * @see https://schema.org/isLocatedInSubcellularLocation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/isLocatedInSubcellularLocation'])]
	#[Assert\Url]
	private ?string $isLocatedInSubcellularLocation = null;

	/**
	 * Disease associated to this BioChemEntity. Such disease can be a MedicalCondition or a URL. If you want to add an evidence supporting the association, please use PropertyValue.
	 *
	 * @see https://schema.org/associatedDisease
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalCondition')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/associatedDisease'])]
	#[Assert\NotNull]
	private MedicalCondition $associatedDisease;

	/**
	 * A BioChemEntity that is known to interact with this item.
	 *
	 * @see https://schema.org/bioChemInteraction
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BioChemEntity')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/bioChemInteraction'])]
	#[Assert\NotNull]
	private BioChemEntity $bioChemInteraction;

	/**
	 * A similar BioChemEntity, e.g., obtained by fingerprint similarity algorithms.
	 *
	 * @see https://schema.org/bioChemSimilarity
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BioChemEntity')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/bioChemSimilarity'])]
	#[Assert\NotNull]
	private BioChemEntity $bioChemSimilarity;

	/**
	 * A role played by the BioChemEntity within a biological context.
	 *
	 * @see https://schema.org/biologicalRole
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/biologicalRole'])]
	#[Assert\NotNull]
	private DefinedTerm $biologicalRole;

	/**
	 * Indicates a BioChemEntity that is (in some sense) a part of this BioChemEntity.
	 *
	 * @see https://schema.org/isPartOfBioChemEntity
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BioChemEntity')]
	#[ApiProperty(types: ['https://schema.org/isPartOfBioChemEntity'])]
	private ?BioChemEntity $isPartOfBioChemEntity = null;

	/**
	 * Indicates a BioChemEntity that (in some sense) has this BioChemEntity as a part.
	 *
	 * @see https://schema.org/hasBioChemEntityPart
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BioChemEntity')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasBioChemEntityPart'])]
	#[Assert\NotNull]
	private BioChemEntity $hasBioChemEntityPart;

	/**
	 * A \[\[Grant\]\] that directly or indirectly provide funding or sponsorship for this item. See also \[\[ownershipFundingInfo\]\].
	 *
	 * @see https://schema.org/funding
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Grant')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/funding'])]
	#[Assert\NotNull]
	private Grant $funding;

	/**
	 * Another BioChemEntity encoding by this one.
	 *
	 * @see https://schema.org/isEncodedByBioChemEntity
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Gene')]
	#[ApiProperty(types: ['https://schema.org/isEncodedByBioChemEntity'])]
	private ?Gene $isEncodedByBioChemEntity = null;

	public function setHasRepresentation(PropertyValue $hasRepresentation): void
	{
		$this->hasRepresentation = $hasRepresentation;
	}

	public function getHasRepresentation(): PropertyValue
	{
		return $this->hasRepresentation;
	}

	public function setHasMolecularFunction(?string $hasMolecularFunction): void
	{
		$this->hasMolecularFunction = $hasMolecularFunction;
	}

	public function getHasMolecularFunction(): ?string
	{
		return $this->hasMolecularFunction;
	}

	public function setTaxonomicRange(?DefinedTerm $taxonomicRange): void
	{
		$this->taxonomicRange = $taxonomicRange;
	}

	public function getTaxonomicRange(): ?DefinedTerm
	{
		return $this->taxonomicRange;
	}

	public function setIsInvolvedInBiologicalProcess(?DefinedTerm $isInvolvedInBiologicalProcess): void
	{
		$this->isInvolvedInBiologicalProcess = $isInvolvedInBiologicalProcess;
	}

	public function getIsInvolvedInBiologicalProcess(): ?DefinedTerm
	{
		return $this->isInvolvedInBiologicalProcess;
	}

	public function setIsLocatedInSubcellularLocation(?string $isLocatedInSubcellularLocation): void
	{
		$this->isLocatedInSubcellularLocation = $isLocatedInSubcellularLocation;
	}

	public function getIsLocatedInSubcellularLocation(): ?string
	{
		return $this->isLocatedInSubcellularLocation;
	}

	public function setAssociatedDisease(MedicalCondition $associatedDisease): void
	{
		$this->associatedDisease = $associatedDisease;
	}

	public function getAssociatedDisease(): MedicalCondition
	{
		return $this->associatedDisease;
	}

	public function setBioChemInteraction(BioChemEntity $bioChemInteraction): void
	{
		$this->bioChemInteraction = $bioChemInteraction;
	}

	public function getBioChemInteraction(): BioChemEntity
	{
		return $this->bioChemInteraction;
	}

	public function setBioChemSimilarity(BioChemEntity $bioChemSimilarity): void
	{
		$this->bioChemSimilarity = $bioChemSimilarity;
	}

	public function getBioChemSimilarity(): BioChemEntity
	{
		return $this->bioChemSimilarity;
	}

	public function setBiologicalRole(DefinedTerm $biologicalRole): void
	{
		$this->biologicalRole = $biologicalRole;
	}

	public function getBiologicalRole(): DefinedTerm
	{
		return $this->biologicalRole;
	}

	public function setIsPartOfBioChemEntity(?BioChemEntity $isPartOfBioChemEntity): void
	{
		$this->isPartOfBioChemEntity = $isPartOfBioChemEntity;
	}

	public function getIsPartOfBioChemEntity(): ?BioChemEntity
	{
		return $this->isPartOfBioChemEntity;
	}

	public function setHasBioChemEntityPart(BioChemEntity $hasBioChemEntityPart): void
	{
		$this->hasBioChemEntityPart = $hasBioChemEntityPart;
	}

	public function getHasBioChemEntityPart(): BioChemEntity
	{
		return $this->hasBioChemEntityPart;
	}

	public function setFunding(Grant $funding): void
	{
		$this->funding = $funding;
	}

	public function getFunding(): Grant
	{
		return $this->funding;
	}

	public function setIsEncodedByBioChemEntity(?Gene $isEncodedByBioChemEntity): void
	{
		$this->isEncodedByBioChemEntity = $isEncodedByBioChemEntity;
	}

	public function getIsEncodedByBioChemEntity(): ?Gene
	{
		return $this->isEncodedByBioChemEntity;
	}
}

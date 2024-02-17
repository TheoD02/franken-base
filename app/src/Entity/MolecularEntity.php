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
 * Any constitutionally or isotopically distinct atom, molecule, ion, ion pair, radical, radical ion, complex, conformer etc., identifiable as a separately distinguishable entity.
 *
 * @see https://schema.org/MolecularEntity
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MolecularEntity'])]
class MolecularEntity extends BioChemEntity
{
	/**
	 * This is the molecular weight of the entity being described, not of the parent. Units should be included in the form '&lt;Number&gt; &lt;unit&gt;', for example '12 amu' or as '&lt;QuantitativeValue&gt;.
	 *
	 * @see https://schema.org/molecularWeight
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/molecularWeight'])]
	private ?string $molecularWeight = null;

	/**
	 * Systematic method of naming chemical compounds as recommended by the International Union of Pure and Applied Chemistry (IUPAC).
	 *
	 * @see https://schema.org/iupacName
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/iupacName'])]
	private ?string $iupacName = null;

	/**
	 * Non-proprietary identifier for molecular entity that can be used in printed and electronic data sources thus enabling easier linking of diverse data compilations.
	 *
	 * @see https://schema.org/inChI
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/inChI'])]
	private ?string $inChI = null;

	/**
	 * Intended use of the BioChemEntity by humans.
	 *
	 * @see https://schema.org/potentialUse
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/potentialUse'])]
	#[Assert\NotNull]
	private DefinedTerm $potentialUse;

	/**
	 * The empirical formula is the simplest whole number ratio of all the atoms in a molecule.
	 *
	 * @see https://schema.org/molecularFormula
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/molecularFormula'])]
	private ?string $molecularFormula = null;

	/**
	 * InChIKey is a hashed version of the full InChI (using the SHA-256 algorithm).
	 *
	 * @see https://schema.org/inChIKey
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/inChIKey'])]
	private ?string $inChIKey = null;

	/**
	 * A role played by the BioChemEntity within a chemical context.
	 *
	 * @see https://schema.org/chemicalRole
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/chemicalRole'])]
	#[Assert\NotNull]
	private DefinedTerm $chemicalRole;

	/**
	 * The monoisotopic mass is the sum of the masses of the atoms in a molecule using the unbound, ground-state, rest mass of the principal (most abundant) isotope for each element instead of the isotopic average mass. Please include the units in the form '&lt;Number&gt; &lt;unit&gt;', for example '770.230488 g/mol' or as '&lt;QuantitativeValue&gt;.
	 *
	 * @see https://schema.org/monoisotopicMolecularWeight
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/monoisotopicMolecularWeight'])]
	private ?string $monoisotopicMolecularWeight = null;

	/**
	 * A specification in form of a line notation for describing the structure of chemical species using short ASCII strings. Double bond stereochemistry \\ indicators may need to be escaped in the string in formats where the backslash is an escape character.
	 *
	 * @see https://schema.org/smiles
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/smiles'])]
	private ?string $smiles = null;

	public function setMolecularWeight(?string $molecularWeight): void
	{
		$this->molecularWeight = $molecularWeight;
	}

	public function getMolecularWeight(): ?string
	{
		return $this->molecularWeight;
	}

	public function setIupacName(?string $iupacName): void
	{
		$this->iupacName = $iupacName;
	}

	public function getIupacName(): ?string
	{
		return $this->iupacName;
	}

	public function setInChI(?string $inChI): void
	{
		$this->inChI = $inChI;
	}

	public function getInChI(): ?string
	{
		return $this->inChI;
	}

	public function setPotentialUse(DefinedTerm $potentialUse): void
	{
		$this->potentialUse = $potentialUse;
	}

	public function getPotentialUse(): DefinedTerm
	{
		return $this->potentialUse;
	}

	public function setMolecularFormula(?string $molecularFormula): void
	{
		$this->molecularFormula = $molecularFormula;
	}

	public function getMolecularFormula(): ?string
	{
		return $this->molecularFormula;
	}

	public function setInChIKey(?string $inChIKey): void
	{
		$this->inChIKey = $inChIKey;
	}

	public function getInChIKey(): ?string
	{
		return $this->inChIKey;
	}

	public function setChemicalRole(DefinedTerm $chemicalRole): void
	{
		$this->chemicalRole = $chemicalRole;
	}

	public function getChemicalRole(): DefinedTerm
	{
		return $this->chemicalRole;
	}

	public function setMonoisotopicMolecularWeight(?string $monoisotopicMolecularWeight): void
	{
		$this->monoisotopicMolecularWeight = $monoisotopicMolecularWeight;
	}

	public function getMonoisotopicMolecularWeight(): ?string
	{
		return $this->monoisotopicMolecularWeight;
	}

	public function setSmiles(?string $smiles): void
	{
		$this->smiles = $smiles;
	}

	public function getSmiles(): ?string
	{
		return $this->smiles;
	}
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A chemical substance is 'a portion of matter of constant composition, composed of molecular entities of the same type or of different types' (source: \[ChEBI:59999\](https://www.ebi.ac.uk/chebi/searchId.do?chebiId=59999)).
 *
 * @see https://schema.org/ChemicalSubstance
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ChemicalSubstance'])]
class ChemicalSubstance extends BioChemEntity
{
    /**
     * The chemical composition describes the identity and relative ratio of the chemical elements that make up the substance.
     *
     * @see https://schema.org/chemicalComposition
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/chemicalComposition'])]
    private ?string $chemicalComposition = null;

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
     * A role played by the BioChemEntity within a chemical context.
     *
     * @see https://schema.org/chemicalRole
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/chemicalRole'])]
    #[Assert\NotNull]
    private DefinedTerm $chemicalRole;

    public function setChemicalComposition(?string $chemicalComposition): void
    {
        $this->chemicalComposition = $chemicalComposition;
    }

    public function getChemicalComposition(): ?string
    {
        return $this->chemicalComposition;
    }

    public function setPotentialUse(DefinedTerm $potentialUse): void
    {
        $this->potentialUse = $potentialUse;
    }

    public function getPotentialUse(): DefinedTerm
    {
        return $this->potentialUse;
    }

    public function setChemicalRole(DefinedTerm $chemicalRole): void
    {
        $this->chemicalRole = $chemicalRole;
    }

    public function getChemicalRole(): DefinedTerm
    {
        return $this->chemicalRole;
    }
}

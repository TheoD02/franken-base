<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A set of organisms asserted to represent a natural cohesive biological unit.
 *
 * @see https://schema.org/Taxon
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Taxon'])]
class Taxon extends Thing
{
    /**
     * The taxonomic rank of this taxon given preferably as a URI from a controlled vocabulary – typically the ranks from TDWG TaxonRank ontology or equivalent Wikidata URIs.
     *
     * @see https://schema.org/taxonRank
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\PropertyValue')]
    #[ApiProperty(types: ['https://schema.org/taxonRank'])]
    private ?PropertyValue $taxonRank = null;

    /**
     * A Defined Term contained in this term set.
     *
     * @see https://schema.org/hasDefinedTerm
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/hasDefinedTerm'])]
    #[Assert\NotNull]
    private DefinedTerm $hasDefinedTerm;

    /**
     * Closest parent taxon of the taxon in question.
     *
     * @see https://schema.org/parentTaxon
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Taxon')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/parentTaxon'])]
    #[Assert\NotNull]
    private Taxon $parentTaxon;

    /**
     * Closest child taxa of the taxon in question.
     *
     * @see https://schema.org/childTaxon
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Taxon')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/childTaxon'])]
    #[Assert\NotNull]
    private Taxon $childTaxon;

    public function setTaxonRank(?PropertyValue $taxonRank): void
    {
        $this->taxonRank = $taxonRank;
    }

    public function getTaxonRank(): ?PropertyValue
    {
        return $this->taxonRank;
    }

    public function setHasDefinedTerm(DefinedTerm $hasDefinedTerm): void
    {
        $this->hasDefinedTerm = $hasDefinedTerm;
    }

    public function getHasDefinedTerm(): DefinedTerm
    {
        return $this->hasDefinedTerm;
    }

    public function setParentTaxon(Taxon $parentTaxon): void
    {
        $this->parentTaxon = $parentTaxon;
    }

    public function getParentTaxon(): Taxon
    {
        return $this->parentTaxon;
    }

    public function setChildTaxon(Taxon $childTaxon): void
    {
        $this->childTaxon = $childTaxon;
    }

    public function getChildTaxon(): Taxon
    {
        return $this->childTaxon;
    }
}

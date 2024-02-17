<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A discrete unit of inheritance which affects one or more biological traits (Source: \[https://en.wikipedia.org/wiki/Gene\](https://en.wikipedia.org/wiki/Gene)). Examples include FOXP2 (Forkhead box protein P2), SCARNA21 (small Cajal body-specific RNA 21), A- (agouti genotype).
 *
 * @see https://schema.org/Gene
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Gene'])]
class Gene extends BioChemEntity
{
    /**
     * A symbolic representation of a BioChemEntity. For example, a nucleotide sequence of a Gene or an amino acid sequence of a Protein.
     *
     * @see https://schema.org/hasBioPolymerSequence
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/hasBioPolymerSequence'])]
    private ?string $hasBioPolymerSequence = null;

    /**
     * Tissue, organ, biological sample, etc in which activity of this gene has been observed experimentally. For example brain, digestive system.
     *
     * @see https://schema.org/expressedIn
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\DefinedTerm')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/expressedIn'])]
    #[Assert\NotNull]
    private DefinedTerm $expressedIn;

    /**
     * Another gene which is a variation of this one.
     *
     * @see https://schema.org/alternativeOf
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Gene')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/alternativeOf'])]
    #[Assert\NotNull]
    private Gene $alternativeOf;

    /**
     * Another BioChemEntity encoded by this one.
     *
     * @see https://schema.org/encodesBioChemEntity
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\BioChemEntity')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/encodesBioChemEntity'])]
    #[Assert\NotNull]
    private BioChemEntity $encodesBioChemEntity;

    public function setHasBioPolymerSequence(?string $hasBioPolymerSequence): void
    {
        $this->hasBioPolymerSequence = $hasBioPolymerSequence;
    }

    public function getHasBioPolymerSequence(): ?string
    {
        return $this->hasBioPolymerSequence;
    }

    public function setExpressedIn(DefinedTerm $expressedIn): void
    {
        $this->expressedIn = $expressedIn;
    }

    public function getExpressedIn(): DefinedTerm
    {
        return $this->expressedIn;
    }

    public function setAlternativeOf(Gene $alternativeOf): void
    {
        $this->alternativeOf = $alternativeOf;
    }

    public function getAlternativeOf(): Gene
    {
        return $this->alternativeOf;
    }

    public function setEncodesBioChemEntity(BioChemEntity $encodesBioChemEntity): void
    {
        $this->encodesBioChemEntity = $encodesBioChemEntity;
    }

    public function getEncodesBioChemEntity(): BioChemEntity
    {
        return $this->encodesBioChemEntity;
    }
}

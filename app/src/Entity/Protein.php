<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Protein is here used in its widest possible definition, as classes of amino acid based molecules. Amyloid-beta Protein in human (UniProt P05067), eukaryota (e.g. an OrthoDB group) or even a single molecule that one can point to are all of type :Protein. A protein can thus be a subclass of another protein, e.g. :Protein as a UniProt record can have multiple isoforms inside it which would also be :Protein. They can be imagined, synthetic, hypothetical or naturally occurring.
 *
 * @see https://schema.org/Protein
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Protein'])]
class Protein extends BioChemEntity
{
    /**
     * A symbolic representation of a BioChemEntity. For example, a nucleotide sequence of a Gene or an amino acid sequence of a Protein.
     *
     * @see https://schema.org/hasBioPolymerSequence
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/hasBioPolymerSequence'])]
    private ?string $hasBioPolymerSequence = null;

    public function setHasBioPolymerSequence(?string $hasBioPolymerSequence): void
    {
        $this->hasBioPolymerSequence = $hasBioPolymerSequence;
    }

    public function getHasBioPolymerSequence(): ?string
    {
        return $this->hasBioPolymerSequence;
    }
}

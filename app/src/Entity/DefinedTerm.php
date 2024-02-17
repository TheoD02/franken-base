<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A word, name, acronym, phrase, etc. with a formal definition. Often used in the context of category or subject classification, glossaries or dictionaries, product or creative work types, etc. Use the name property for the term being defined, use termCode if the term has an alpha-numeric code allocated, use description to provide the definition of the term.
 *
 * @see https://schema.org/DefinedTerm
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['definedTerm' => DefinedTerm::class, 'categoryCode' => CategoryCode::class])]
class DefinedTerm extends Intangible
{
    /**
     * A \[\[DefinedTermSet\]\] that contains this term.
     *
     * @see https://schema.org/inDefinedTermSet
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/inDefinedTermSet'])]
    #[Assert\Url]
    private ?string $inDefinedTermSet = null;

    /**
     * A code that identifies this \[\[DefinedTerm\]\] within a \[\[DefinedTermSet\]\].
     *
     * @see https://schema.org/termCode
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/termCode'])]
    private ?string $termCode = null;

    public function setInDefinedTermSet(?string $inDefinedTermSet): void
    {
        $this->inDefinedTermSet = $inDefinedTermSet;
    }

    public function getInDefinedTermSet(): ?string
    {
        return $this->inDefinedTermSet;
    }

    public function setTermCode(?string $termCode): void
    {
        $this->termCode = $termCode;
    }

    public function getTermCode(): ?string
    {
        return $this->termCode;
    }
}

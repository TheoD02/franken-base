<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A SpeakableSpecification indicates (typically via \[\[xpath\]\] or \[\[cssSelector\]\]) sections of a document that are highlighted as particularly \[\[speakable\]\]. Instances of this type are expected to be used primarily as values of the \[\[speakable\]\] property.
 *
 * @see https://schema.org/SpeakableSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SpeakableSpecification'])]
class SpeakableSpecification extends Intangible
{
    /**
     * A CSS selector, e.g. of a \[\[SpeakableSpecification\]\] or \[\[WebPageElement\]\]. In the latter case, multiple matches within a page can constitute a single conceptual "Web page element".
     *
     * @see https://schema.org/cssSelector
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\CssSelectorType')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/cssSelector'])]
    #[Assert\NotNull]
    private CssSelectorType $cssSelector;

    /**
     * An XPath, e.g. of a \[\[SpeakableSpecification\]\] or \[\[WebPageElement\]\]. In the latter case, multiple matches within a page can constitute a single conceptual "Web page element".
     *
     * @see https://schema.org/xpath
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\XPathType')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/xpath'])]
    #[Assert\NotNull]
    private XPathType $xpath;

    public function setCssSelector(CssSelectorType $cssSelector): void
    {
        $this->cssSelector = $cssSelector;
    }

    public function getCssSelector(): CssSelectorType
    {
        return $this->cssSelector;
    }

    public function setXpath(XPathType $xpath): void
    {
        $this->xpath = $xpath;
    }

    public function getXpath(): XPathType
    {
        return $this->xpath;
    }
}

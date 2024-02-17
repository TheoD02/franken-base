<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Role that represents a Web link, e.g. as expressed via the 'url' property. Its linkRelationship property can indicate URL-based and plain textual link types, e.g. those in IANA link registry or others such as 'amphtml'. This structure provides a placeholder where details from HTML's link element can be represented outside of HTML, e.g. in JSON-LD feeds.
 *
 * @see https://schema.org/LinkRole
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LinkRole'])]
class LinkRole extends Role
{
    /**
     * The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
     *
     * @see https://schema.org/inLanguage
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/inLanguage'])]
    private ?string $inLanguage = null;

    /**
     * Indicates the relationship type of a Web link.
     *
     * @see https://schema.org/linkRelationship
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/linkRelationship'])]
    private ?string $linkRelationship = null;

    public function setInLanguage(?string $inLanguage): void
    {
        $this->inLanguage = $inLanguage;
    }

    public function getInLanguage(): ?string
    {
        return $this->inLanguage;
    }

    public function setLinkRelationship(?string $linkRelationship): void
    {
        $this->linkRelationship = $linkRelationship;
    }

    public function getLinkRelationship(): ?string
    {
        return $this->linkRelationship;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The act of authoring written creative content.
 *
 * @see https://schema.org/WriteAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WriteAction'])]
class WriteAction extends CreateAction
{
    /**
     * The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
     *
     * @see https://schema.org/inLanguage
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/inLanguage'])]
    private ?string $inLanguage = null;

    public function setInLanguage(?string $inLanguage): void
    {
        $this->inLanguage = $inLanguage;
    }

    public function getInLanguage(): ?string
    {
        return $this->inLanguage;
    }
}

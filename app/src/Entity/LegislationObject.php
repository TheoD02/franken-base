<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Enum\LegalValueLevel;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A specific object or file containing a Legislation. Note that the same Legislation can be published in multiple files. For example, a digitally signed PDF, a plain PDF and an HTML version.
 *
 * @see https://schema.org/LegislationObject
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LegislationObject'])]
class LegislationObject extends Legislation
{
    /**
     * The legal value of this legislation file. The same legislation can be written in multiple files with different legal values. Typically a digitally signed PDF have a "stronger" legal value than the HTML file of the same act.
     *
     * @see https://schema.org/legislationLegalValue
     */
    #[ORM\Column(nullable: true)]
    #[ApiProperty(types: ['https://schema.org/legislationLegalValue'])]
    #[Assert\Choice(callback: [LegalValueLevel::class, 'toArray'])]
    private ?string $legislationLegalValue = null;

    public function setLegislationLegalValue(?string $legislationLegalValue): void
    {
        $this->legislationLegalValue = $legislationLegalValue;
    }

    public function getLegislationLegalValue(): ?string
    {
        return $this->legislationLegalValue;
    }
}

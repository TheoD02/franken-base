<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Indicates a range of postal codes, usually defined as the set of valid codes between \[\[postalCodeBegin\]\] and \[\[postalCodeEnd\]\], inclusively.
 *
 * @see https://schema.org/PostalCodeRangeSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PostalCodeRangeSpecification'])]
class PostalCodeRangeSpecification extends StructuredValue
{
    /**
     * First postal code in a range (included).
     *
     * @see https://schema.org/postalCodeBegin
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/postalCodeBegin'])]
    private ?string $postalCodeBegin = null;

    /**
     * Last postal code in the range (included). Needs to be after \[\[postalCodeBegin\]\].
     *
     * @see https://schema.org/postalCodeEnd
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/postalCodeEnd'])]
    private ?string $postalCodeEnd = null;

    public function setPostalCodeBegin(?string $postalCodeBegin): void
    {
        $this->postalCodeBegin = $postalCodeBegin;
    }

    public function getPostalCodeBegin(): ?string
    {
        return $this->postalCodeBegin;
    }

    public function setPostalCodeEnd(?string $postalCodeEnd): void
    {
        $this->postalCodeEnd = $postalCodeEnd;
    }

    public function getPostalCodeEnd(): ?string
    {
        return $this->postalCodeEnd;
    }
}

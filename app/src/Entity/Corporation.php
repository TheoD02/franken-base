<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Organization: A business corporation.
 *
 * @see https://schema.org/Corporation
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Corporation'])]
class Corporation extends Organization
{
    /**
     * The exchange traded instrument associated with a Corporation object. The tickerSymbol is expressed as an exchange and an instrument name separated by a space character. For the exchange component of the tickerSymbol attribute, we recommend using the controlled vocabulary of Market Identifier Codes (MIC) specified in ISO 15022.
     *
     * @see https://schema.org/tickerSymbol
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/tickerSymbol'])]
    private ?string $tickerSymbol = null;

    public function setTickerSymbol(?string $tickerSymbol): void
    {
        $this->tickerSymbol = $tickerSymbol;
    }

    public function getTickerSymbol(): ?string
    {
        return $this->tickerSymbol;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A statistical distribution of monetary amounts.
 *
 * @see https://schema.org/MonetaryAmountDistribution
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MonetaryAmountDistribution'])]
class MonetaryAmountDistribution extends QuantitativeValueDistribution
{
    /**
     * The currency in which the monetary amount is expressed.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
     *
     * @see https://schema.org/currency
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/currency'])]
    private ?string $currency = null;

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }
}

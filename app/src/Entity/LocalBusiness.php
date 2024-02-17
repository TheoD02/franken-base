<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * A particular physical business or branch of an organization. Examples of LocalBusiness include a restaurant, a particular branch of a restaurant chain, a branch of a bank, a medical practice, a club, a bowling alley, etc.
 *
 * @see https://schema.org/LocalBusiness
 */
#[ORM\MappedSuperclass]
abstract class LocalBusiness extends Organization
{
    /**
     * The price range of the business, for example ```$$$```.
     *
     * @see https://schema.org/priceRange
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/priceRange'])]
    private ?string $priceRange = null;

    /**
     * The general opening hours for a business. Opening hours can be specified as a weekly time range, starting with days, then times per day. Multiple days can be listed with commas ',' separating each day. Day or time ranges are specified using a hyphen '-'.\\n\\n\* Days are specified using the following two-letter combinations: ```Mo```, ```Tu```, ```We```, ```Th```, ```Fr```, ```Sa```, ```Su```.\\n\* Times are specified using 24:00 format. For example, 3pm is specified as ```15:00```, 10am as ```10:00```. \\n\* Here is an example: `<time itemprop="openingHours" datetime="Tu,Th 16:00-20:00">Tuesdays and Thursdays 4-8pm</time>`.\\n\* If a business is open 7 days a week, then it can be specified as `<time itemprop="openingHours" datetime="Mo-Su">Monday through Sunday, all day</time>`.
     *
     * @see https://schema.org/openingHours
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/openingHours'])]
    private ?string $openingHours = null;

    /**
     * The currency accepted.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
     *
     * @see https://schema.org/currenciesAccepted
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/currenciesAccepted'])]
    private ?string $currenciesAccepted = null;

    /**
     * Cash, Credit Card, Cryptocurrency, Local Exchange Tradings System, etc.
     *
     * @see https://schema.org/paymentAccepted
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/paymentAccepted'])]
    private ?string $paymentAccepted = null;

    public function setPriceRange(?string $priceRange): void
    {
        $this->priceRange = $priceRange;
    }

    public function getPriceRange(): ?string
    {
        return $this->priceRange;
    }

    public function setOpeningHours(?string $openingHours): void
    {
        $this->openingHours = $openingHours;
    }

    public function getOpeningHours(): ?string
    {
        return $this->openingHours;
    }

    public function setCurrenciesAccepted(?string $currenciesAccepted): void
    {
        $this->currenciesAccepted = $currenciesAccepted;
    }

    public function getCurrenciesAccepted(): ?string
    {
        return $this->currenciesAccepted;
    }

    public function setPaymentAccepted(?string $paymentAccepted): void
    {
        $this->paymentAccepted = $paymentAccepted;
    }

    public function getPaymentAccepted(): ?string
    {
        return $this->paymentAccepted;
    }
}

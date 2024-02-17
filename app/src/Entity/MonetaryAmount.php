<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A monetary value or range. This type can be used to describe an amount of money such as $50 USD, or a range as in describing a bank account being suitable for a balance between £1,000 and £1,000,000 GBP, or the value of a salary, etc. It is recommended to use \[\[PriceSpecification\]\] Types to describe the price of an Offer, Invoice, etc.
 *
 * @see https://schema.org/MonetaryAmount
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MonetaryAmount'])]
class MonetaryAmount extends StructuredValue
{
    /**
     * The value of a \[\[QuantitativeValue\]\] (including \[\[Observation\]\]) or property value node.\\n\\n\* For \[\[QuantitativeValue\]\] and \[\[MonetaryAmount\]\], the recommended type for values is 'Number'.\\n\* For \[\[PropertyValue\]\], it can be 'Text', 'Number', 'Boolean', or 'StructuredValue'.\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.
     *
     * @see https://schema.org/value
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\StructuredValue')]
    #[ApiProperty(types: ['https://schema.org/value'])]
    private ?StructuredValue $value = null;

    /**
     * The currency in which the monetary amount is expressed.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
     *
     * @see https://schema.org/currency
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/currency'])]
    private ?string $currency = null;

    /**
     * The upper value of some characteristic or property.
     *
     * @see https://schema.org/maxValue
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/maxValue'])]
    private ?string $maxValue = null;

    /**
     * The lower value of some characteristic or property.
     *
     * @see https://schema.org/minValue
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/minValue'])]
    private ?string $minValue = null;

    /**
     * The date when the item becomes valid.
     *
     * @see https://schema.org/validFrom
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/validFrom'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $validFrom = null;

    /**
     * The date after when the item is not valid. For example the end of an offer, salary period, or a period of opening hours.
     *
     * @see https://schema.org/validThrough
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
    #[ApiProperty(types: ['https://schema.org/validThrough'])]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $validThrough = null;

    public function setValue(?StructuredValue $value): void
    {
        $this->value = $value;
    }

    public function getValue(): ?StructuredValue
    {
        return $this->value;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setMaxValue(?string $maxValue): void
    {
        $this->maxValue = $maxValue;
    }

    public function getMaxValue(): ?string
    {
        return $this->maxValue;
    }

    public function setMinValue(?string $minValue): void
    {
        $this->minValue = $minValue;
    }

    public function getMinValue(): ?string
    {
        return $this->minValue;
    }

    public function setValidFrom(?\DateTimeInterface $validFrom): void
    {
        $this->validFrom = $validFrom;
    }

    public function getValidFrom(): ?\DateTimeInterface
    {
        return $this->validFrom;
    }

    public function setValidThrough(?\DateTimeInterface $validThrough): void
    {
        $this->validThrough = $validThrough;
    }

    public function getValidThrough(): ?\DateTimeInterface
    {
        return $this->validThrough;
    }
}

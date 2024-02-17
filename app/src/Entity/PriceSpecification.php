<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A structured value representing a price or price range. Typically, only the subclasses of this type are used for markup. It is recommended to use \[\[MonetaryAmount\]\] to describe independent amounts of money such as a salary, credit card limits, etc.
 *
 * @see https://schema.org/PriceSpecification
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'priceSpecification' => PriceSpecification::class,
	'deliveryChargeSpecification' => DeliveryChargeSpecification::class,
	'compoundPriceSpecification' => CompoundPriceSpecification::class,
	'unitPriceSpecification' => UnitPriceSpecification::class,
	'paymentChargeSpecification' => PaymentChargeSpecification::class,
])]
class PriceSpecification extends StructuredValue
{
	/**
	 * The transaction volume, in a monetary unit, for which the offer or price specification is valid, e.g. for indicating a minimal purchasing volume, to express free shipping above a certain order volume, or to limit the acceptance of credit cards to purchases to a certain minimal amount.
	 *
	 * @see https://schema.org/eligibleTransactionVolume
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
	#[ApiProperty(types: ['https://schema.org/eligibleTransactionVolume'])]
	private ?PriceSpecification $eligibleTransactionVolume = null;

	/**
	 * The currency of the price, or a price component when attached to \[\[PriceSpecification\]\] and its subtypes.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
	 *
	 * @see https://schema.org/priceCurrency
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/priceCurrency'])]
	#[Assert\NotNull]
	private string $priceCurrency;

	/**
	 * Specifies whether the applicable value-added tax (VAT) is included in the price specification or not.
	 *
	 * @see https://schema.org/valueAddedTaxIncluded
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/valueAddedTaxIncluded'])]
	private ?bool $valueAddedTaxIncluded = null;

	/**
	 * The offer price of a product, or of a price component when attached to PriceSpecification and its subtypes.\\n\\nUsage guidelines:\\n\\n\* Use the \[\[priceCurrency\]\] property (with standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR") instead of including \[ambiguous symbols\](http://en.wikipedia.org/wiki/Dollar\_sign#Currencies\_that\_use\_the\_dollar\_or\_peso\_sign) such as '$' in the value.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.\\n\* Note that both \[RDFa\](http://www.w3.org/TR/xhtml-rdfa-primer/#using-the-content-attribute) and Microdata syntax allow the use of a "content=" attribute for publishing simple machine-readable values alongside more human-friendly formatting.\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.
	 *
	 * @see https://schema.org/price
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/price'])]
	private ?string $price = null;

	/**
	 * The interval and unit of measurement of ordering quantities for which the offer or price specification is valid. This allows e.g. specifying that a certain freight charge is valid only for a certain quantity.
	 *
	 * @see https://schema.org/eligibleQuantity
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/eligibleQuantity'])]
	private ?QuantitativeValue $eligibleQuantity = null;

	/**
	 * The lowest price if the price is a range.
	 *
	 * @see https://schema.org/minPrice
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/minPrice'])]
	#[Assert\NotNull]
	private string $minPrice;

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

	/**
	 * The highest price if the price is a range.
	 *
	 * @see https://schema.org/maxPrice
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/maxPrice'])]
	#[Assert\NotNull]
	private string $maxPrice;

	public function setEligibleTransactionVolume(?PriceSpecification $eligibleTransactionVolume): void
	{
		$this->eligibleTransactionVolume = $eligibleTransactionVolume;
	}

	public function getEligibleTransactionVolume(): ?PriceSpecification
	{
		return $this->eligibleTransactionVolume;
	}

	public function setPriceCurrency(string $priceCurrency): void
	{
		$this->priceCurrency = $priceCurrency;
	}

	public function getPriceCurrency(): string
	{
		return $this->priceCurrency;
	}

	public function setValueAddedTaxIncluded(?bool $valueAddedTaxIncluded): void
	{
		$this->valueAddedTaxIncluded = $valueAddedTaxIncluded;
	}

	public function getValueAddedTaxIncluded(): ?bool
	{
		return $this->valueAddedTaxIncluded;
	}

	public function setPrice(?string $price): void
	{
		$this->price = $price;
	}

	public function getPrice(): ?string
	{
		return $this->price;
	}

	public function setEligibleQuantity(?QuantitativeValue $eligibleQuantity): void
	{
		$this->eligibleQuantity = $eligibleQuantity;
	}

	public function getEligibleQuantity(): ?QuantitativeValue
	{
		return $this->eligibleQuantity;
	}

	public function setMinPrice(string $minPrice): void
	{
		$this->minPrice = $minPrice;
	}

	public function getMinPrice(): string
	{
		return $this->minPrice;
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

	public function setMaxPrice(string $maxPrice): void
	{
		$this->maxPrice = $maxPrice;
	}

	public function getMaxPrice(): string
	{
		return $this->maxPrice;
	}
}

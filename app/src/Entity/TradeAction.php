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
 * The act of participating in an exchange of goods and services for monetary compensation. An agent trades an object, product or service with a participant in exchange for a one time or periodic payment.
 *
 * @see https://schema.org/TradeAction
 */
#[ORM\MappedSuperclass]
abstract class TradeAction extends Action
{
	/**
	 * @var Collection<PriceSpecification>|null One or more detailed price specifications, indicating the unit price and delivery or payment charges.
	 * @see https://schema.org/priceSpecification
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\PriceSpecification')]
	#[ORM\JoinTable(name: 'trade_action_price_specification_price_specification')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/priceSpecification'])]
	private ?Collection $priceSpecification = null;

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
	 * The offer price of a product, or of a price component when attached to PriceSpecification and its subtypes.\\n\\nUsage guidelines:\\n\\n\* Use the \[\[priceCurrency\]\] property (with standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR") instead of including \[ambiguous symbols\](http://en.wikipedia.org/wiki/Dollar\_sign#Currencies\_that\_use\_the\_dollar\_or\_peso\_sign) such as '$' in the value.\\n\* Use '.' (Unicode 'FULL STOP' (U+002E)) rather than ',' to indicate a decimal point. Avoid using these symbols as a readability separator.\\n\* Note that both \[RDFa\](http://www.w3.org/TR/xhtml-rdfa-primer/#using-the-content-attribute) and Microdata syntax allow the use of a "content=" attribute for publishing simple machine-readable values alongside more human-friendly formatting.\\n\* Use values from 0123456789 (Unicode 'DIGIT ZERO' (U+0030) to 'DIGIT NINE' (U+0039)) rather than superficially similar Unicode symbols.
	 *
	 * @see https://schema.org/price
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/price'])]
	private ?string $price = null;

	function __construct()
	{
		$this->priceSpecification = new ArrayCollection();
	}

	public function addPriceSpecification(PriceSpecification $priceSpecification): void
	{
		$this->priceSpecification[] = $priceSpecification;
	}

	public function removePriceSpecification(PriceSpecification $priceSpecification): void
	{
		$this->priceSpecification->removeElement($priceSpecification);
	}

	/**
	 * @return Collection<PriceSpecification>|null
	 */
	public function getPriceSpecification(): Collection
	{
		return $this->priceSpecification;
	}

	public function setPriceCurrency(string $priceCurrency): void
	{
		$this->priceCurrency = $priceCurrency;
	}

	public function getPriceCurrency(): string
	{
		return $this->priceCurrency;
	}

	public function setPrice(?string $price): void
	{
		$this->price = $price;
	}

	public function getPrice(): ?string
	{
		return $this->price;
	}
}

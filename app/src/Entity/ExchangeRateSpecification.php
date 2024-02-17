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
 * A structured value representing exchange rate.
 *
 * @see https://schema.org/ExchangeRateSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ExchangeRateSpecification'])]
class ExchangeRateSpecification extends StructuredValue
{
	/**
	 * The difference between the price at which a broker or other intermediary buys and sells foreign currency.
	 *
	 * @see https://schema.org/exchangeRateSpread
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
	#[ApiProperty(types: ['https://schema.org/exchangeRateSpread'])]
	private ?MonetaryAmount $exchangeRateSpread = null;

	/**
	 * The currency in which the monetary amount is expressed.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
	 *
	 * @see https://schema.org/currency
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/currency'])]
	private ?string $currency = null;

	/**
	 * The current price of a currency.
	 *
	 * @see https://schema.org/currentExchangeRate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\UnitPriceSpecification')]
	#[ApiProperty(types: ['https://schema.org/currentExchangeRate'])]
	private ?UnitPriceSpecification $currentExchangeRate = null;

	public function setExchangeRateSpread(?MonetaryAmount $exchangeRateSpread): void
	{
		$this->exchangeRateSpread = $exchangeRateSpread;
	}

	public function getExchangeRateSpread(): ?MonetaryAmount
	{
		return $this->exchangeRateSpread;
	}

	public function setCurrency(?string $currency): void
	{
		$this->currency = $currency;
	}

	public function getCurrency(): ?string
	{
		return $this->currency;
	}

	public function setCurrentExchangeRate(?UnitPriceSpecification $currentExchangeRate): void
	{
		$this->currentExchangeRate = $currentExchangeRate;
	}

	public function getCurrentExchangeRate(): ?UnitPriceSpecification
	{
		return $this->currentExchangeRate;
	}
}

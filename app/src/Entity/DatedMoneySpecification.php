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
 * A DatedMoneySpecification represents monetary values with optional start and end dates. For example, this could represent an employee's salary over a specific period of time. \_\_Note:\_\_ This type has been superseded by \[\[MonetaryAmount\]\], use of that type is recommended.
 *
 * @see https://schema.org/DatedMoneySpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DatedMoneySpecification'])]
class DatedMoneySpecification extends StructuredValue
{
	/**
	 * The start date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
	 *
	 * @see https://schema.org/startDate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/startDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $startDate = null;

	/**
	 * The end date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
	 *
	 * @see https://schema.org/endDate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/endDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $endDate = null;

	/**
	 * The amount of money.
	 *
	 * @see https://schema.org/amount
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
	#[ApiProperty(types: ['https://schema.org/amount'])]
	private ?MonetaryAmount $amount = null;

	/**
	 * The currency in which the monetary amount is expressed.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
	 *
	 * @see https://schema.org/currency
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/currency'])]
	private ?string $currency = null;

	public function setStartDate(?\DateTimeInterface $startDate): void
	{
		$this->startDate = $startDate;
	}

	public function getStartDate(): ?\DateTimeInterface
	{
		return $this->startDate;
	}

	public function setEndDate(?\DateTimeInterface $endDate): void
	{
		$this->endDate = $endDate;
	}

	public function getEndDate(): ?\DateTimeInterface
	{
		return $this->endDate;
	}

	public function setAmount(?MonetaryAmount $amount): void
	{
		$this->amount = $amount;
	}

	public function getAmount(): ?MonetaryAmount
	{
		return $this->amount;
	}

	public function setCurrency(?string $currency): void
	{
		$this->currency = $currency;
	}

	public function getCurrency(): ?string
	{
		return $this->currency;
	}
}

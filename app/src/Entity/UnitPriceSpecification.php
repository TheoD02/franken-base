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
use App\Enum\PriceComponentTypeEnumeration;
use App\Enum\PriceTypeEnumeration;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The price asked for a given offer by the respective organization or person.
 *
 * @see https://schema.org/UnitPriceSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/UnitPriceSpecification'])]
class UnitPriceSpecification extends PriceSpecification
{
	/**
	 * The reference quantity for which a certain price applies, e.g. 1 EUR per 4 kWh of electricity. This property is a replacement for unitOfMeasurement for the advanced cases where the price does not relate to a standard unit.
	 *
	 * @see https://schema.org/referenceQuantity
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/referenceQuantity'])]
	private ?QuantitativeValue $referenceQuantity = null;

	/**
	 * This property specifies the minimal quantity and rounding increment that will be the basis for the billing. The unit of measurement is specified by the unitCode property.
	 *
	 * @see https://schema.org/billingIncrement
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/billingIncrement'])]
	private ?string $billingIncrement = null;

	/**
	 * Specifies after how much time this price (or price component) becomes valid and billing starts. Can be used, for example, to model a price increase after the first year of a subscription. The unit of measurement is specified by the unitCode property.
	 *
	 * @see https://schema.org/billingStart
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/billingStart'])]
	private ?string $billingStart = null;

	/**
	 * Defines the type of a price specified for an offered product, for example a list price, a (temporary) sale price or a manufacturer suggested retail price. If multiple prices are specified for an offer the \[\[priceType\]\] property can be used to identify the type of each such specified price. The value of priceType can be specified as a value from enumeration PriceTypeEnumeration or as a free form text string for price types that are not already predefined in PriceTypeEnumeration.
	 *
	 * @see https://schema.org/priceType
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/priceType'])]
	#[Assert\Choice(callback: [PriceTypeEnumeration::class, 'toArray'])]
	private ?string $priceType = null;

	/**
	 * The unit of measurement given using the UN/CEFACT Common Code (3 characters) or a URL. Other codes than the UN/CEFACT Common Code may be used with a prefix followed by a colon.
	 *
	 * @see https://schema.org/unitCode
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/unitCode'])]
	#[Assert\NotNull]
	private string $unitCode;

	/**
	 * Identifies a price component (for example, a line item on an invoice), part of the total price for an offer.
	 *
	 * @see https://schema.org/priceComponentType
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/priceComponentType'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [PriceComponentTypeEnumeration::class, 'toArray'])]
	private string $priceComponentType;

	/**
	 * A string or text indicating the unit of measurement. Useful if you cannot provide a standard unit code for [unitCode](unitCode).
	 *
	 * @see https://schema.org/unitText
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/unitText'])]
	private ?string $unitText = null;

	/**
	 * Specifies for how long this price (or price component) will be billed. Can be used, for example, to model the contractual duration of a subscription or payment plan. Type can be either a Duration or a Number (in which case the unit of measurement, for example month, is specified by the unitCode property).
	 *
	 * @see https://schema.org/billingDuration
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/billingDuration'])]
	#[Assert\NotNull]
	private Duration $billingDuration;

	public function setReferenceQuantity(?QuantitativeValue $referenceQuantity): void
	{
		$this->referenceQuantity = $referenceQuantity;
	}

	public function getReferenceQuantity(): ?QuantitativeValue
	{
		return $this->referenceQuantity;
	}

	public function setBillingIncrement(?string $billingIncrement): void
	{
		$this->billingIncrement = $billingIncrement;
	}

	public function getBillingIncrement(): ?string
	{
		return $this->billingIncrement;
	}

	public function setBillingStart(?string $billingStart): void
	{
		$this->billingStart = $billingStart;
	}

	public function getBillingStart(): ?string
	{
		return $this->billingStart;
	}

	public function setPriceType(?string $priceType): void
	{
		$this->priceType = $priceType;
	}

	public function getPriceType(): ?string
	{
		return $this->priceType;
	}

	public function setUnitCode(string $unitCode): void
	{
		$this->unitCode = $unitCode;
	}

	public function getUnitCode(): string
	{
		return $this->unitCode;
	}

	public function setPriceComponentType(string $priceComponentType): void
	{
		$this->priceComponentType = $priceComponentType;
	}

	public function getPriceComponentType(): string
	{
		return $this->priceComponentType;
	}

	public function setUnitText(?string $unitText): void
	{
		$this->unitText = $unitText;
	}

	public function getUnitText(): ?string
	{
		return $this->unitText;
	}

	public function setBillingDuration(Duration $billingDuration): void
	{
		$this->billingDuration = $billingDuration;
	}

	public function getBillingDuration(): Duration
	{
		return $this->billingDuration;
	}
}

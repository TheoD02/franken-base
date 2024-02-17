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
use App\Enum\PriceTypeEnumeration;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A compound price specification is one that bundles multiple prices that all apply in combination for different dimensions of consumption. Use the name property of the attached unit price specification for indicating the dimension of a price component (e.g. "electricity" or "final cleaning").
 *
 * @see https://schema.org/CompoundPriceSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CompoundPriceSpecification'])]
class CompoundPriceSpecification extends PriceSpecification
{
	/**
	 * This property links to all \[\[UnitPriceSpecification\]\] nodes that apply in parallel for the \[\[CompoundPriceSpecification\]\] node.
	 *
	 * @see https://schema.org/priceComponent
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\UnitPriceSpecification')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/priceComponent'])]
	#[Assert\NotNull]
	private UnitPriceSpecification $priceComponent;

	/**
	 * Defines the type of a price specified for an offered product, for example a list price, a (temporary) sale price or a manufacturer suggested retail price. If multiple prices are specified for an offer the \[\[priceType\]\] property can be used to identify the type of each such specified price. The value of priceType can be specified as a value from enumeration PriceTypeEnumeration or as a free form text string for price types that are not already predefined in PriceTypeEnumeration.
	 *
	 * @see https://schema.org/priceType
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/priceType'])]
	#[Assert\Choice(callback: [PriceTypeEnumeration::class, 'toArray'])]
	private ?string $priceType = null;

	public function setPriceComponent(UnitPriceSpecification $priceComponent): void
	{
		$this->priceComponent = $priceComponent;
	}

	public function getPriceComponent(): UnitPriceSpecification
	{
		return $this->priceComponent;
	}

	public function setPriceType(?string $priceType): void
	{
		$this->priceType = $priceType;
	}

	public function getPriceType(): ?string
	{
		return $this->priceType;
	}
}

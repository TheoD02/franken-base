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
 * A ProductGroup represents a group of \[\[Product\]\]s that vary only in certain well-described ways, such as by \[\[size\]\], \[\[color\]\], \[\[material\]\] etc. While a ProductGroup itself is not directly offered for sale, the various varying products that it represents can be. The ProductGroup serves as a prototype or template, standing in for all of the products who have an \[\[isVariantOf\]\] relationship to it. As such, properties (including additional types) can be applied to the ProductGroup to represent characteristics shared by each of the (possibly very many) variants. Properties that reference a ProductGroup are not included in this mechanism; neither are the following specific properties \[\[variesBy\]\], \[\[hasVariant\]\], \[\[url\]\].
 *
 * @see https://schema.org/ProductGroup
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ProductGroup'])]
class ProductGroup extends Product
{
	/**
	 * Indicates a textual identifier for a ProductGroup.
	 *
	 * @see https://schema.org/productGroupID
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/productGroupID'])]
	private ?string $productGroupID = null;

	/**
	 * Indicates the property or properties by which the variants in a \[\[ProductGroup\]\] vary, e.g. their size, color etc. Schema.org properties can be referenced by their short name e.g. "color"; terms defined elsewhere can be referenced with their URIs.
	 *
	 * @see https://schema.org/variesBy
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/variesBy'])]
	private ?string $variesBy = null;

	/**
	 * Indicates a \[\[Product\]\] that is a member of this \[\[ProductGroup\]\] (or \[\[ProductModel\]\]).
	 *
	 * @see https://schema.org/hasVariant
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Product')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/hasVariant'])]
	#[Assert\NotNull]
	private Product $hasVariant;

	public function setProductGroupID(?string $productGroupID): void
	{
		$this->productGroupID = $productGroupID;
	}

	public function getProductGroupID(): ?string
	{
		return $this->productGroupID;
	}

	public function setVariesBy(?string $variesBy): void
	{
		$this->variesBy = $variesBy;
	}

	public function getVariesBy(): ?string
	{
		return $this->variesBy;
	}

	public function setHasVariant(Product $hasVariant): void
	{
		$this->hasVariant = $hasVariant;
	}

	public function getHasVariant(): Product
	{
		return $this->hasVariant;
	}
}

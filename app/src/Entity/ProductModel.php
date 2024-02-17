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
 * A datasheet or vendor specification of a product (in the sense of a prototypical description).
 *
 * @see https://schema.org/ProductModel
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ProductModel'])]
class ProductModel extends Product
{
	/**
	 * @var Collection<ProductModel>|null A pointer from a newer variant of a product to its previous, often discontinued predecessor.
	 * @see https://schema.org/successorOf
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\ProductModel')]
	#[ORM\JoinTable(name: 'product_model_product_model_successor_of')]
	#[ORM\InverseJoinColumn(name: 'successor_of_product_model_id', unique: true)]
	#[ApiProperty(types: ['https://schema.org/successorOf'])]
	private ?Collection $successorOf = null;

	/**
	 * @var Collection<ProductModel>|null A pointer from a previous, often discontinued variant of the product to its newer variant.
	 * @see https://schema.org/predecessorOf
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\ProductModel')]
	#[ORM\JoinTable(name: 'product_model_product_model_predecessor_of')]
	#[ORM\InverseJoinColumn(name: 'predecessor_of_product_model_id', unique: true)]
	#[ApiProperty(types: ['https://schema.org/predecessorOf'])]
	private ?Collection $predecessorOf = null;

	function __construct()
	{
		parent::__construct();
		$this->successorOf = new ArrayCollection();
		$this->predecessorOf = new ArrayCollection();
	}

	public function addSuccessorOf(ProductModel $successorOf): void
	{
		$this->successorOf[] = $successorOf;
	}

	public function removeSuccessorOf(ProductModel $successorOf): void
	{
		$this->successorOf->removeElement($successorOf);
	}

	/**
	 * @return Collection<ProductModel>|null
	 */
	public function getSuccessorOf(): Collection
	{
		return $this->successorOf;
	}

	public function addPredecessorOf(ProductModel $predecessorOf): void
	{
		$this->predecessorOf[] = $predecessorOf;
	}

	public function removePredecessorOf(ProductModel $predecessorOf): void
	{
		$this->predecessorOf->removeElement($predecessorOf);
	}

	/**
	 * @return Collection<ProductModel>|null
	 */
	public function getPredecessorOf(): Collection
	{
		return $this->predecessorOf;
	}
}

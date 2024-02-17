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
 * An item used as either a tool or supply when performing the instructions for how to achieve a result.
 *
 * @see https://schema.org/HowToItem
 */
#[ORM\MappedSuperclass]
abstract class HowToItem extends ListItem
{
	/**
	 * @var Collection<QuantitativeValue>|null The required quantity of the item(s).
	 * @see https://schema.org/requiredQuantity
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ORM\JoinTable(name: 'how_to_item_quantitative_value_required_quantity')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/requiredQuantity'])]
	private ?Collection $requiredQuantity = null;

	function __construct()
	{
		$this->requiredQuantity = new ArrayCollection();
	}

	public function addRequiredQuantity(QuantitativeValue $requiredQuantity): void
	{
		$this->requiredQuantity[] = $requiredQuantity;
	}

	public function removeRequiredQuantity(QuantitativeValue $requiredQuantity): void
	{
		$this->requiredQuantity->removeElement($requiredQuantity);
	}

	/**
	 * @return Collection<QuantitativeValue>|null
	 */
	public function getRequiredQuantity(): Collection
	{
		return $this->requiredQuantity;
	}
}

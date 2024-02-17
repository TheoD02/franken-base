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
 * A placeholder for multiple similar products of the same kind.
 *
 * @see https://schema.org/SomeProducts
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SomeProducts'])]
class SomeProducts extends Product
{
	/**
	 * The current approximate inventory level for the item or items.
	 *
	 * @see https://schema.org/inventoryLevel
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/inventoryLevel'])]
	private ?QuantitativeValue $inventoryLevel = null;

	public function setInventoryLevel(?QuantitativeValue $inventoryLevel): void
	{
		$this->inventoryLevel = $inventoryLevel;
	}

	public function getInventoryLevel(): ?QuantitativeValue
	{
		return $this->inventoryLevel;
	}
}

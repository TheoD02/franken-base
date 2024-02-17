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
 * The act of taking money from a buyer in exchange for goods or services rendered. An agent sells an object, product, or service to a buyer for a price. Reciprocal of BuyAction.
 *
 * @see https://schema.org/SellAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SellAction'])]
#[ORM\AssociationOverrides([
	new ORM\AssociationOverride(
		name: 'priceSpecification',
		joinTable: new ORM\JoinTable(name: 'join_table_1ea11940'),
		joinColumns: [new ORM\JoinColumn()],
		inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
	),
])]
class SellAction extends TradeAction
{
	/**
	 * A sub property of participant. The participant/person/organization that bought the object.
	 *
	 * @see https://schema.org/buyer
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/buyer'])]
	#[Assert\NotNull]
	private Person $buyer;

	public function setBuyer(Person $buyer): void
	{
		$this->buyer = $buyer;
	}

	public function getBuyer(): Person
	{
		return $this->buyer;
	}
}

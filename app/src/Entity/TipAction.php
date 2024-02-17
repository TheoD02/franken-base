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
 * The act of giving money voluntarily to a beneficiary in recognition of services rendered.
 *
 * @see https://schema.org/TipAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TipAction'])]
#[ORM\AssociationOverrides([
	new ORM\AssociationOverride(
		name: 'priceSpecification',
		joinTable: new ORM\JoinTable(name: 'trade_action_price_specification_price_specification_tip_action'),
		joinColumns: [new ORM\JoinColumn()],
		inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
	),
])]
class TipAction extends TradeAction
{
	/**
	 * A sub property of participant. The participant who is at the receiving end of the action.
	 *
	 * @see https://schema.org/recipient
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/recipient'])]
	#[Assert\NotNull]
	private Organization $recipient;

	public function setRecipient(Organization $recipient): void
	{
		$this->recipient = $recipient;
	}

	public function getRecipient(): Organization
	{
		return $this->recipient;
	}
}

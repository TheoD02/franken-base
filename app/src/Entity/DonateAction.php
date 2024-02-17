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
 * The act of providing goods, services, or money without compensation, often for philanthropic reasons.
 *
 * @see https://schema.org/DonateAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DonateAction'])]
#[ORM\AssociationOverrides([
	new ORM\AssociationOverride(
		name: 'priceSpecification',
		joinTable: new ORM\JoinTable(name: 'join_table_52331a0b'),
		joinColumns: [new ORM\JoinColumn()],
		inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
	),
])]
class DonateAction extends TradeAction
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

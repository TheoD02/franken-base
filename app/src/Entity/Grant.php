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
 * A grant, typically financial or otherwise quantifiable, of resources. Typically a \[\[funder\]\] sponsors some \[\[MonetaryAmount\]\] to an \[\[Organization\]\] or \[\[Person\]\], sometimes not necessarily via a dedicated or long-lived \[\[Project\]\], resulting in one or more outputs, or \[\[fundedItem\]\]s. For financial sponsorship, indicate the \[\[funder\]\] of a \[\[MonetaryGrant\]\]. For non-financial support, indicate \[\[sponsor\]\] of \[\[Grant\]\]s of resources (e.g. office space). Grants support activities directed towards some agreed collective goals, often but not always organized as \[\[Project\]\]s. Long-lived projects are sometimes sponsored by a variety of grants over time, but it is also common for a project to be associated with a single grant. The amount of a \[\[Grant\]\] is represented using \[\[amount\]\] as a \[\[MonetaryAmount\]\].
 *
 * @see https://schema.org/Grant
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['grant' => Grant::class, 'monetaryGrant' => MonetaryGrant::class])]
#[ORM\Table(name: '`grant`')]
class Grant extends Intangible
{
	/**
	 * A person or organization that supports (sponsors) something through some kind of financial contribution.
	 *
	 * @see https://schema.org/funder
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/funder'])]
	#[Assert\NotNull]
	private Organization $funder;

	/**
	 * A person or organization that supports a thing through a pledge, promise, or financial contribution. E.g. a sponsor of a Medical Study or a corporate sponsor of an event.
	 *
	 * @see https://schema.org/sponsor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/sponsor'])]
	#[Assert\NotNull]
	private Organization $sponsor;

	/**
	 * Indicates something directly or indirectly funded or sponsored through a \[\[Grant\]\]. See also \[\[ownershipFundingInfo\]\].
	 *
	 * @see https://schema.org/fundedItem
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\BioChemEntity')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/fundedItem'])]
	#[Assert\NotNull]
	private BioChemEntity $fundedItem;

	public function setFunder(Organization $funder): void
	{
		$this->funder = $funder;
	}

	public function getFunder(): Organization
	{
		return $this->funder;
	}

	public function setSponsor(Organization $sponsor): void
	{
		$this->sponsor = $sponsor;
	}

	public function getSponsor(): Organization
	{
		return $this->sponsor;
	}

	public function setFundedItem(BioChemEntity $fundedItem): void
	{
		$this->fundedItem = $fundedItem;
	}

	public function getFundedItem(): BioChemEntity
	{
		return $this->fundedItem;
	}
}

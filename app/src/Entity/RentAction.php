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
 * The act of giving money in return for temporary use, but not ownership, of an object such as a vehicle or property. For example, an agent rents a property from a landlord in exchange for a periodic payment.
 *
 * @see https://schema.org/RentAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RentAction'])]
#[ORM\AssociationOverrides([
	new ORM\AssociationOverride(
		name: 'priceSpecification',
		joinTable: new ORM\JoinTable(name: 'join_table_1edf1949'),
		joinColumns: [new ORM\JoinColumn()],
		inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
	),
])]
class RentAction extends TradeAction
{
	/**
	 * A sub property of participant. The real estate agent involved in the action.
	 *
	 * @see https://schema.org/realEstateAgent
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\RealEstateAgent')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/realEstateAgent'])]
	#[Assert\NotNull]
	private RealEstateAgent $realEstateAgent;

	/**
	 * A sub property of participant. The owner of the real estate property.
	 *
	 * @see https://schema.org/landlord
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/landlord'])]
	#[Assert\NotNull]
	private Organization $landlord;

	public function setRealEstateAgent(RealEstateAgent $realEstateAgent): void
	{
		$this->realEstateAgent = $realEstateAgent;
	}

	public function getRealEstateAgent(): RealEstateAgent
	{
		return $this->realEstateAgent;
	}

	public function setLandlord(Organization $landlord): void
	{
		$this->landlord = $landlord;
	}

	public function getLandlord(): Organization
	{
		return $this->landlord;
	}
}

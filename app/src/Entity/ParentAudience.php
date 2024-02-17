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
 * A set of characteristics describing parents, who can be interested in viewing some content.
 *
 * @see https://schema.org/ParentAudience
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ParentAudience'])]
#[ORM\AssociationOverrides([
	new ORM\AssociationOverride(
		name: 'healthCondition',
		joinTable: new ORM\JoinTable(name: 'join_table_4eaf19fa'),
		joinColumns: [new ORM\JoinColumn()],
		inverseJoinColumns: [new ORM\InverseJoinColumn(unique: true)],
	),
])]
class ParentAudience extends PeopleAudience
{
	/**
	 * Maximal age of the child.
	 *
	 * @see https://schema.org/childMaxAge
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/childMaxAge'])]
	private ?string $childMaxAge = null;

	/**
	 * Minimal age of the child.
	 *
	 * @see https://schema.org/childMinAge
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/childMinAge'])]
	private ?string $childMinAge = null;

	public function setChildMaxAge(?string $childMaxAge): void
	{
		$this->childMaxAge = $childMaxAge;
	}

	public function getChildMaxAge(): ?string
	{
		return $this->childMaxAge;
	}

	public function setChildMinAge(?string $childMinAge): void
	{
		$this->childMinAge = $childMinAge;
	}

	public function getChildMinAge(): ?string
	{
		return $this->childMinAge;
	}
}

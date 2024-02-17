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
 * Represents additional information about a relationship or property. For example a Role can be used to say that a 'member' role linking some SportsTeam to a player occurred during a particular time period. Or that a Person's 'actor' role in a Movie was for some particular characterName. Such properties can be attached to a Role entity, which is then associated with the main entities using ordinary properties like 'member' or 'actor'.\\n\\nSee also \[blog post\](http://blog.schema.org/2014/06/introducing-role.html).
 *
 * @see https://schema.org/Role
 */
#[ORM\MappedSuperclass]
#[ORM\Table(name: '`role`')]
abstract class Role extends Intangible
{
	/**
	 * A role played, performed or filled by a person or organization. For example, the team of creators for a comic book might fill the roles named 'inker', 'penciller', and 'letterer'; or an athlete in a SportsTeam might play in the position named 'Quarterback'.
	 *
	 * @see https://schema.org/roleName
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/roleName'])]
	#[Assert\Url]
	private ?string $roleName = null;

	/**
	 * The start date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
	 *
	 * @see https://schema.org/startDate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/startDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $startDate = null;

	/**
	 * The end date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
	 *
	 * @see https://schema.org/endDate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Date')]
	#[ApiProperty(types: ['https://schema.org/endDate'])]
	#[Assert\Type(\DateTimeInterface::class)]
	private ?\DateTimeInterface $endDate = null;

	public function setRoleName(?string $roleName): void
	{
		$this->roleName = $roleName;
	}

	public function getRoleName(): ?string
	{
		return $this->roleName;
	}

	public function setStartDate(?\DateTimeInterface $startDate): void
	{
		$this->startDate = $startDate;
	}

	public function getStartDate(): ?\DateTimeInterface
	{
		return $this->startDate;
	}

	public function setEndDate(?\DateTimeInterface $endDate): void
	{
		$this->endDate = $endDate;
	}

	public function getEndDate(): ?\DateTimeInterface
	{
		return $this->endDate;
	}
}

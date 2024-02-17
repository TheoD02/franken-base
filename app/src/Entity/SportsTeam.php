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
use App\Enum\GenderType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Organization: Sports team.
 *
 * @see https://schema.org/SportsTeam
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SportsTeam'])]
class SportsTeam extends SportsOrganization
{
	/**
	 * A person that acts in a coaching role for a sports team.
	 *
	 * @see https://schema.org/coach
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/coach'])]
	#[Assert\NotNull]
	private Person $coach;

	/**
	 * A person that acts as performing member of a sports team; a player as opposed to a coach.
	 *
	 * @see https://schema.org/athlete
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/athlete'])]
	#[Assert\NotNull]
	private Person $athlete;

	/**
	 * Gender of something, typically a \[\[Person\]\], but possibly also fictional characters, animals, etc. While https://schema.org/Male and https://schema.org/Female may be used, text strings are also acceptable for people who do not identify as a binary gender. The \[\[gender\]\] property can also be used in an extended sense to cover e.g. the gender of sports teams. As with the gender of individuals, we do not try to enumerate all possibilities. A mixed-gender \[\[SportsTeam\]\] can be indicated with a text value of "Mixed".
	 *
	 * @see https://schema.org/gender
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/gender'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [GenderType::class, 'toArray'])]
	private string $gender;

	public function setCoach(Person $coach): void
	{
		$this->coach = $coach;
	}

	public function getCoach(): Person
	{
		return $this->coach;
	}

	public function setAthlete(Person $athlete): void
	{
		$this->athlete = $athlete;
	}

	public function getAthlete(): Person
	{
		return $this->athlete;
	}

	public function setGender(string $gender): void
	{
		$this->gender = $gender;
	}

	public function getGender(): string
	{
		return $this->gender;
	}
}

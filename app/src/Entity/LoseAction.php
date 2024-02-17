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
 * The act of being defeated in a competitive activity.
 *
 * @see https://schema.org/LoseAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LoseAction'])]
class LoseAction extends AchieveAction
{
	/**
	 * A sub property of participant. The winner of the action.
	 *
	 * @see https://schema.org/winner
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/winner'])]
	#[Assert\NotNull]
	private Person $winner;

	public function setWinner(Person $winner): void
	{
		$this->winner = $winner;
	}

	public function getWinner(): Person
	{
		return $this->winner;
	}
}

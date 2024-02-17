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
 * The act of achieving victory in a competitive activity.
 *
 * @see https://schema.org/WinAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WinAction'])]
class WinAction extends AchieveAction
{
	/**
	 * A sub property of participant. The loser of the action.
	 *
	 * @see https://schema.org/loser
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/loser'])]
	#[Assert\NotNull]
	private Person $loser;

	public function setLoser(Person $loser): void
	{
		$this->loser = $loser;
	}

	public function getLoser(): Person
	{
		return $this->loser;
	}
}

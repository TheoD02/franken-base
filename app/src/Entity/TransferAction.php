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
 * The act of transferring/moving (abstract or concrete) animate or inanimate objects from one place to another.
 *
 * @see https://schema.org/TransferAction
 */
#[ORM\MappedSuperclass]
abstract class TransferAction extends Action
{
	/**
	 * A sub property of location. The final location of the object or the agent after the action.
	 *
	 * @see https://schema.org/toLocation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/toLocation'])]
	#[Assert\NotNull]
	private Place $toLocation;

	/**
	 * A sub property of location. The original location of the object or the agent before the action.
	 *
	 * @see https://schema.org/fromLocation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Place')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/fromLocation'])]
	#[Assert\NotNull]
	private Place $fromLocation;

	public function setToLocation(Place $toLocation): void
	{
		$this->toLocation = $toLocation;
	}

	public function getToLocation(): Place
	{
		return $this->toLocation;
	}

	public function setFromLocation(Place $fromLocation): void
	{
		$this->fromLocation = $fromLocation;
	}

	public function getFromLocation(): Place
	{
		return $this->fromLocation;
	}
}

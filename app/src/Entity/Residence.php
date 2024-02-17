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
 * The place where a person lives.
 *
 * @see https://schema.org/Residence
 */
#[ORM\MappedSuperclass]
abstract class Residence extends Place
{
	/**
	 * A floorplan of some \[\[Accommodation\]\].
	 *
	 * @see https://schema.org/accommodationFloorPlan
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\FloorPlan')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/accommodationFloorPlan'])]
	#[Assert\NotNull]
	private FloorPlan $accommodationFloorPlan;

	public function setAccommodationFloorPlan(FloorPlan $accommodationFloorPlan): void
	{
		$this->accommodationFloorPlan = $accommodationFloorPlan;
	}

	public function getAccommodationFloorPlan(): FloorPlan
	{
		return $this->accommodationFloorPlan;
	}
}

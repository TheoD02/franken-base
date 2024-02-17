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
 * Indicates employment-related experience requirements, e.g. \[\[monthsOfExperience\]\].
 *
 * @see https://schema.org/OccupationalExperienceRequirements
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/OccupationalExperienceRequirements'])]
class OccupationalExperienceRequirements extends Intangible
{
	/**
	 * Indicates the minimal number of months of experience required for a position.
	 *
	 * @see https://schema.org/monthsOfExperience
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/monthsOfExperience'])]
	private ?string $monthsOfExperience = null;

	public function setMonthsOfExperience(?string $monthsOfExperience): void
	{
		$this->monthsOfExperience = $monthsOfExperience;
	}

	public function getMonthsOfExperience(): ?string
	{
		return $this->monthsOfExperience;
	}
}

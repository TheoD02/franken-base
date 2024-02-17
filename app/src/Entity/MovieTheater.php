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
 * A movie theater.
 *
 * @see https://schema.org/MovieTheater
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MovieTheater'])]
class MovieTheater extends EntertainmentBusiness
{
	/**
	 * The number of screens in the movie theater.
	 *
	 * @see https://schema.org/screenCount
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/screenCount'])]
	private ?string $screenCount = null;

	public function setScreenCount(?string $screenCount): void
	{
		$this->screenCount = $screenCount;
	}

	public function getScreenCount(): ?string
	{
		return $this->screenCount;
	}
}

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
 * The act of participating in performance arts.
 *
 * @see https://schema.org/PerformAction
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PerformAction'])]
class PerformAction extends PlayAction
{
	/**
	 * A sub property of location. The entertainment business where the action occurred.
	 *
	 * @see https://schema.org/entertainmentBusiness
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\EntertainmentBusiness')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/entertainmentBusiness'])]
	#[Assert\NotNull]
	private EntertainmentBusiness $entertainmentBusiness;

	public function setEntertainmentBusiness(EntertainmentBusiness $entertainmentBusiness): void
	{
		$this->entertainmentBusiness = $entertainmentBusiness;
	}

	public function getEntertainmentBusiness(): EntertainmentBusiness
	{
		return $this->entertainmentBusiness;
	}
}

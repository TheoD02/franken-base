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
 * A service provided by a government organization, e.g. food stamps, veterans benefits, etc.
 *
 * @see https://schema.org/GovernmentService
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/GovernmentService'])]
class GovernmentService extends Service
{
	/**
	 * The operating organization, if different from the provider. This enables the representation of services that are provided by an organization, but operated by another organization like a subcontractor.
	 *
	 * @see https://schema.org/serviceOperator
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Organization')]
	#[ApiProperty(types: ['https://schema.org/serviceOperator'])]
	private ?Organization $serviceOperator = null;

	/**
	 * Indicates a legal jurisdiction, e.g. of some legislation, or where some government service is based.
	 *
	 * @see https://schema.org/jurisdiction
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/jurisdiction'])]
	#[Assert\NotNull]
	private AdministrativeArea $jurisdiction;

	public function setServiceOperator(?Organization $serviceOperator): void
	{
		$this->serviceOperator = $serviceOperator;
	}

	public function getServiceOperator(): ?Organization
	{
		return $this->serviceOperator;
	}

	public function setJurisdiction(AdministrativeArea $jurisdiction): void
	{
		$this->jurisdiction = $jurisdiction;
	}

	public function getJurisdiction(): AdministrativeArea
	{
		return $this->jurisdiction;
	}
}

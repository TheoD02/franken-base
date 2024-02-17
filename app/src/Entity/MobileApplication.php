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
 * A software application designed specifically to work well on a mobile device such as a telephone.
 *
 * @see https://schema.org/MobileApplication
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MobileApplication'])]
class MobileApplication extends SoftwareApplication
{
	/**
	 * @var Collection<Text>|null Specifies specific carrier(s) requirements for the application (e.g. an application may only work on a specific carrier network).
	 * @see https://schema.org/carrierRequirements
	 */
	#[ORM\ManyToMany(targetEntity: 'App\Entity\Text')]
	#[ORM\JoinTable(name: 'mobile_application_text_carrier_requirements')]
	#[ORM\InverseJoinColumn(unique: true)]
	#[ApiProperty(types: ['https://schema.org/carrierRequirements'])]
	private ?Collection $carrierRequirements = null;

	function __construct()
	{
		parent::__construct();
		$this->carrierRequirements = new ArrayCollection();
	}

	public function addCarrierRequirement(string $carrierRequirement): void
	{
		$this->carrierRequirements[] = $carrierRequirement;
	}

	public function removeCarrierRequirement(string $carrierRequirement): void
	{
		$this->carrierRequirements->removeElement($carrierRequirement);
	}

	/**
	 * @return Collection<Text>|null
	 */
	public function getCarrierRequirements(): Collection
	{
		return $this->carrierRequirements;
	}
}

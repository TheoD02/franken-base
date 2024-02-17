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
use App\Enum\MedicalSpecialty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A medical organization (physical or not), such as hospital, institution or clinic.
 *
 * @see https://schema.org/MedicalOrganization
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap([
	'medicalOrganization' => MedicalOrganization::class,
	'pharmacy' => Pharmacy::class,
	'veterinaryCare' => VeterinaryCare::class,
	'diagnosticLab' => DiagnosticLab::class,
])]
class MedicalOrganization extends Organization
{
	/**
	 * A medical specialty of the provider.
	 *
	 * @see https://schema.org/medicalSpecialty
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/medicalSpecialty'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [MedicalSpecialty::class, 'toArray'])]
	private string $medicalSpecialty;

	/**
	 * Name or unique ID of network. (Networks are often reused across different insurance plans.)
	 *
	 * @see https://schema.org/healthPlanNetworkId
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/healthPlanNetworkId'])]
	private ?string $healthPlanNetworkId = null;

	/**
	 * Whether the provider is accepting new patients.
	 *
	 * @see https://schema.org/isAcceptingNewPatients
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
	#[ApiProperty(types: ['https://schema.org/isAcceptingNewPatients'])]
	private ?bool $isAcceptingNewPatients = null;

	public function setMedicalSpecialty(string $medicalSpecialty): void
	{
		$this->medicalSpecialty = $medicalSpecialty;
	}

	public function getMedicalSpecialty(): string
	{
		return $this->medicalSpecialty;
	}

	public function setHealthPlanNetworkId(?string $healthPlanNetworkId): void
	{
		$this->healthPlanNetworkId = $healthPlanNetworkId;
	}

	public function getHealthPlanNetworkId(): ?string
	{
		return $this->healthPlanNetworkId;
	}

	public function setIsAcceptingNewPatients(?bool $isAcceptingNewPatients): void
	{
		$this->isAcceptingNewPatients = $isAcceptingNewPatients;
	}

	public function getIsAcceptingNewPatients(): ?bool
	{
		return $this->isAcceptingNewPatients;
	}
}

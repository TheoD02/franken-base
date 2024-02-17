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
 * The anatomical location at which two or more bones make contact.
 *
 * @see https://schema.org/Joint
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Joint'])]
class Joint extends AnatomicalStructure
{
	/**
	 * The degree of mobility the joint allows.
	 *
	 * @see https://schema.org/functionalClass
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
	#[ApiProperty(types: ['https://schema.org/functionalClass'])]
	private ?MedicalEntity $functionalClass = null;

	/**
	 * The name given to how bone physically connects to each other.
	 *
	 * @see https://schema.org/structuralClass
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/structuralClass'])]
	private ?string $structuralClass = null;

	/**
	 * The biomechanical properties of the bone.
	 *
	 * @see https://schema.org/biomechnicalClass
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/biomechnicalClass'])]
	private ?string $biomechnicalClass = null;

	public function setFunctionalClass(?MedicalEntity $functionalClass): void
	{
		$this->functionalClass = $functionalClass;
	}

	public function getFunctionalClass(): ?MedicalEntity
	{
		return $this->functionalClass;
	}

	public function setStructuralClass(?string $structuralClass): void
	{
		$this->structuralClass = $structuralClass;
	}

	public function getStructuralClass(): ?string
	{
		return $this->structuralClass;
	}

	public function setBiomechnicalClass(?string $biomechnicalClass): void
	{
		$this->biomechnicalClass = $biomechnicalClass;
	}

	public function getBiomechnicalClass(): ?string
	{
		return $this->biomechnicalClass;
	}
}

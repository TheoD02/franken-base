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
 * A strategy of regulating the intake of food to achieve or maintain a specific health-related goal.
 *
 * @see https://schema.org/Diet
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Diet'])]
class Diet extends CreativeWork
{
	/**
	 * Medical expert advice related to the plan.
	 *
	 * @see https://schema.org/expertConsiderations
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/expertConsiderations'])]
	private ?string $expertConsiderations = null;

	/**
	 * Specific physiologic risks associated to the diet plan.
	 *
	 * @see https://schema.org/risks
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/risks'])]
	private ?string $risks = null;

	/**
	 * Nutritional information specific to the dietary plan. May include dietary recommendations on what foods to avoid, what foods to consume, and specific alterations/deviations from the USDA or other regulatory body's approved dietary guidelines.
	 *
	 * @see https://schema.org/dietFeatures
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/dietFeatures'])]
	private ?string $dietFeatures = null;

	/**
	 * People or organizations that endorse the plan.
	 *
	 * @see https://schema.org/endorsers
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Person')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/endorsers'])]
	#[Assert\NotNull]
	private Person $endorsers;

	/**
	 * Specific physiologic benefits associated to the plan.
	 *
	 * @see https://schema.org/physiologicalBenefits
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/physiologicalBenefits'])]
	private ?string $physiologicalBenefits = null;

	public function setExpertConsiderations(?string $expertConsiderations): void
	{
		$this->expertConsiderations = $expertConsiderations;
	}

	public function getExpertConsiderations(): ?string
	{
		return $this->expertConsiderations;
	}

	public function setRisks(?string $risks): void
	{
		$this->risks = $risks;
	}

	public function getRisks(): ?string
	{
		return $this->risks;
	}

	public function setDietFeatures(?string $dietFeatures): void
	{
		$this->dietFeatures = $dietFeatures;
	}

	public function getDietFeatures(): ?string
	{
		return $this->dietFeatures;
	}

	public function setEndorsers(Person $endorsers): void
	{
		$this->endorsers = $endorsers;
	}

	public function getEndorsers(): Person
	{
		return $this->endorsers;
	}

	public function setPhysiologicalBenefits(?string $physiologicalBenefits): void
	{
		$this->physiologicalBenefits = $physiologicalBenefits;
	}

	public function getPhysiologicalBenefits(): ?string
	{
		return $this->physiologicalBenefits;
	}
}

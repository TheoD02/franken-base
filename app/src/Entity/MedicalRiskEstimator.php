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
 * Any rule set or interactive tool for estimating the risk of developing a complication or condition.
 *
 * @see https://schema.org/MedicalRiskEstimator
 */
#[ORM\MappedSuperclass]
abstract class MedicalRiskEstimator extends MedicalEntity
{
	/**
	 * A modifiable or non-modifiable risk factor included in the calculation, e.g. age, coexisting condition.
	 *
	 * @see https://schema.org/includedRiskFactor
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalRiskFactor')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/includedRiskFactor'])]
	#[Assert\NotNull]
	private MedicalRiskFactor $includedRiskFactor;

	/**
	 * The condition, complication, or symptom whose risk is being estimated.
	 *
	 * @see https://schema.org/estimatesRiskOf
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MedicalEntity')]
	#[ApiProperty(types: ['https://schema.org/estimatesRiskOf'])]
	private ?MedicalEntity $estimatesRiskOf = null;

	public function setIncludedRiskFactor(MedicalRiskFactor $includedRiskFactor): void
	{
		$this->includedRiskFactor = $includedRiskFactor;
	}

	public function getIncludedRiskFactor(): MedicalRiskFactor
	{
		return $this->includedRiskFactor;
	}

	public function setEstimatesRiskOf(?MedicalEntity $estimatesRiskOf): void
	{
		$this->estimatesRiskOf = $estimatesRiskOf;
	}

	public function getEstimatesRiskOf(): ?MedicalEntity
	{
		return $this->estimatesRiskOf;
	}
}

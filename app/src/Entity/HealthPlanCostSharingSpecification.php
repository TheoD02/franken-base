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
 * A description of costs to the patient under a given network or formulary.
 *
 * @see https://schema.org/HealthPlanCostSharingSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/HealthPlanCostSharingSpecification'])]
class HealthPlanCostSharingSpecification extends Intangible
{
	/**
	 * The copay amount.
	 *
	 * @see https://schema.org/healthPlanCopay
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\PriceSpecification')]
	#[ApiProperty(types: ['https://schema.org/healthPlanCopay'])]
	private ?PriceSpecification $healthPlanCopay = null;

	/**
	 * The category or type of pharmacy associated with this cost sharing.
	 *
	 * @see https://schema.org/healthPlanPharmacyCategory
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/healthPlanPharmacyCategory'])]
	private ?string $healthPlanPharmacyCategory = null;

	/**
	 * Whether the copay is before or after deductible, etc. TODO: Is this a closed set?
	 *
	 * @see https://schema.org/healthPlanCopayOption
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/healthPlanCopayOption'])]
	private ?string $healthPlanCopayOption = null;

	/**
	 * The rate of coinsurance expressed as a number between 0.0 and 1.0.
	 *
	 * @see https://schema.org/healthPlanCoinsuranceRate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/healthPlanCoinsuranceRate'])]
	private ?string $healthPlanCoinsuranceRate = null;

	/**
	 * Whether the coinsurance applies before or after deductible, etc. TODO: Is this a closed set?
	 *
	 * @see https://schema.org/healthPlanCoinsuranceOption
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/healthPlanCoinsuranceOption'])]
	private ?string $healthPlanCoinsuranceOption = null;

	public function setHealthPlanCopay(?PriceSpecification $healthPlanCopay): void
	{
		$this->healthPlanCopay = $healthPlanCopay;
	}

	public function getHealthPlanCopay(): ?PriceSpecification
	{
		return $this->healthPlanCopay;
	}

	public function setHealthPlanPharmacyCategory(?string $healthPlanPharmacyCategory): void
	{
		$this->healthPlanPharmacyCategory = $healthPlanPharmacyCategory;
	}

	public function getHealthPlanPharmacyCategory(): ?string
	{
		return $this->healthPlanPharmacyCategory;
	}

	public function setHealthPlanCopayOption(?string $healthPlanCopayOption): void
	{
		$this->healthPlanCopayOption = $healthPlanCopayOption;
	}

	public function getHealthPlanCopayOption(): ?string
	{
		return $this->healthPlanCopayOption;
	}

	public function setHealthPlanCoinsuranceRate(?string $healthPlanCoinsuranceRate): void
	{
		$this->healthPlanCoinsuranceRate = $healthPlanCoinsuranceRate;
	}

	public function getHealthPlanCoinsuranceRate(): ?string
	{
		return $this->healthPlanCoinsuranceRate;
	}

	public function setHealthPlanCoinsuranceOption(?string $healthPlanCoinsuranceOption): void
	{
		$this->healthPlanCoinsuranceOption = $healthPlanCoinsuranceOption;
	}

	public function getHealthPlanCoinsuranceOption(): ?string
	{
		return $this->healthPlanCoinsuranceOption;
	}
}

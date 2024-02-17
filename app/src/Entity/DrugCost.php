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
use App\Enum\DrugCostCategory;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The cost per unit of a medical drug. Note that this type is not meant to represent the price in an offer of a drug for sale; see the Offer type for that. This type will typically be used to tag wholesale or average retail cost of a drug, or maximum reimbursable cost. Costs of medical drugs vary widely depending on how and where they are paid for, so while this type captures some of the variables, costs should be used with caution by consumers of this schema's markup.
 *
 * @see https://schema.org/DrugCost
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DrugCost'])]
class DrugCost extends MedicalEntity
{
	/**
	 * The cost per unit of the drug.
	 *
	 * @see https://schema.org/costPerUnit
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/costPerUnit'])]
	private ?string $costPerUnit = null;

	/**
	 * Additional details to capture the origin of the cost data. For example, 'Medicare Part B'.
	 *
	 * @see https://schema.org/costOrigin
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/costOrigin'])]
	private ?string $costOrigin = null;

	/**
	 * The currency (in 3-letter) of the drug cost. See: http://en.wikipedia.org/wiki/ISO\_4217.
	 *
	 * @see https://schema.org/costCurrency
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/costCurrency'])]
	private ?string $costCurrency = null;

	/**
	 * The location in which the status applies.
	 *
	 * @see https://schema.org/applicableLocation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\AdministrativeArea')]
	#[ApiProperty(types: ['https://schema.org/applicableLocation'])]
	private ?AdministrativeArea $applicableLocation = null;

	/**
	 * The unit in which the drug is measured, e.g. '5 mg tablet'.
	 *
	 * @see https://schema.org/drugUnit
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/drugUnit'])]
	private ?string $drugUnit = null;

	/**
	 * The category of cost, such as wholesale, retail, reimbursement cap, etc.
	 *
	 * @see https://schema.org/costCategory
	 */
	#[ORM\Column(nullable: true)]
	#[ApiProperty(types: ['https://schema.org/costCategory'])]
	#[Assert\Choice(callback: [DrugCostCategory::class, 'toArray'])]
	private ?string $costCategory = null;

	public function setCostPerUnit(?string $costPerUnit): void
	{
		$this->costPerUnit = $costPerUnit;
	}

	public function getCostPerUnit(): ?string
	{
		return $this->costPerUnit;
	}

	public function setCostOrigin(?string $costOrigin): void
	{
		$this->costOrigin = $costOrigin;
	}

	public function getCostOrigin(): ?string
	{
		return $this->costOrigin;
	}

	public function setCostCurrency(?string $costCurrency): void
	{
		$this->costCurrency = $costCurrency;
	}

	public function getCostCurrency(): ?string
	{
		return $this->costCurrency;
	}

	public function setApplicableLocation(?AdministrativeArea $applicableLocation): void
	{
		$this->applicableLocation = $applicableLocation;
	}

	public function getApplicableLocation(): ?AdministrativeArea
	{
		return $this->applicableLocation;
	}

	public function setDrugUnit(?string $drugUnit): void
	{
		$this->drugUnit = $drugUnit;
	}

	public function getDrugUnit(): ?string
	{
		return $this->drugUnit;
	}

	public function setCostCategory(?string $costCategory): void
	{
		$this->costCategory = $costCategory;
	}

	public function getCostCategory(): ?string
	{
		return $this->costCategory;
	}
}

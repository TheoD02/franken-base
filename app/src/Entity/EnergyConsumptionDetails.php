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
use App\Enum\EUEnergyEfficiencyEnumeration;
use App\Enum\EnergyEfficiencyEnumeration;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EnergyConsumptionDetails represents information related to the energy efficiency of a product that consumes energy. The information that can be provided is based on international regulations such as for example \[EU directive 2017/1369\](https://eur-lex.europa.eu/eli/reg/2017/1369/oj) for energy labeling and the \[Energy labeling rule\](https://www.ftc.gov/enforcement/rules/rulemaking-regulatory-reform-proceedings/energy-water-use-labeling-consumer) under the Energy Policy and Conservation Act (EPCA) in the US.
 *
 * @see https://schema.org/EnergyConsumptionDetails
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EnergyConsumptionDetails'])]
class EnergyConsumptionDetails extends Intangible
{
	/**
	 * Specifies the most energy efficient class on the regulated EU energy consumption scale for the product category a product belongs to. For example, energy consumption for televisions placed on the market after January 1, 2020 is scaled from D to A+++.
	 *
	 * @see https://schema.org/energyEfficiencyScaleMax
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/energyEfficiencyScaleMax'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [EUEnergyEfficiencyEnumeration::class, 'toArray'])]
	private string $energyEfficiencyScaleMax;

	/**
	 * Specifies the least energy efficient class on the regulated EU energy consumption scale for the product category a product belongs to. For example, energy consumption for televisions placed on the market after January 1, 2020 is scaled from D to A+++.
	 *
	 * @see https://schema.org/energyEfficiencyScaleMin
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/energyEfficiencyScaleMin'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [EUEnergyEfficiencyEnumeration::class, 'toArray'])]
	private string $energyEfficiencyScaleMin;

	/**
	 * Defines the energy efficiency Category (which could be either a rating out of range of values or a yes/no certification) for a product according to an international energy efficiency standard.
	 *
	 * @see https://schema.org/hasEnergyEfficiencyCategory
	 */
	#[ORM\Column]
	#[ApiProperty(types: ['https://schema.org/hasEnergyEfficiencyCategory'])]
	#[Assert\NotNull]
	#[Assert\Choice(callback: [EnergyEfficiencyEnumeration::class, 'toArray'])]
	private string $hasEnergyEfficiencyCategory;

	public function setEnergyEfficiencyScaleMax(string $energyEfficiencyScaleMax): void
	{
		$this->energyEfficiencyScaleMax = $energyEfficiencyScaleMax;
	}

	public function getEnergyEfficiencyScaleMax(): string
	{
		return $this->energyEfficiencyScaleMax;
	}

	public function setEnergyEfficiencyScaleMin(string $energyEfficiencyScaleMin): void
	{
		$this->energyEfficiencyScaleMin = $energyEfficiencyScaleMin;
	}

	public function getEnergyEfficiencyScaleMin(): string
	{
		return $this->energyEfficiencyScaleMin;
	}

	public function setHasEnergyEfficiencyCategory(string $hasEnergyEfficiencyCategory): void
	{
		$this->hasEnergyEfficiencyCategory = $hasEnergyEfficiencyCategory;
	}

	public function getHasEnergyEfficiencyCategory(): string
	{
		return $this->hasEnergyEfficiencyCategory;
	}
}

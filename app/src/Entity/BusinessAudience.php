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
 * A set of characteristics belonging to businesses, e.g. who compose an item's target audience.
 *
 * @see https://schema.org/BusinessAudience
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BusinessAudience'])]
class BusinessAudience extends Audience
{
	/**
	 * The size of the business in annual revenue.
	 *
	 * @see https://schema.org/yearlyRevenue
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/yearlyRevenue'])]
	private ?QuantitativeValue $yearlyRevenue = null;

	/**
	 * The number of employees in an organization, e.g. business.
	 *
	 * @see https://schema.org/numberOfEmployees
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/numberOfEmployees'])]
	private ?QuantitativeValue $numberOfEmployees = null;

	/**
	 * The age of the business.
	 *
	 * @see https://schema.org/yearsInOperation
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
	#[ApiProperty(types: ['https://schema.org/yearsInOperation'])]
	private ?QuantitativeValue $yearsInOperation = null;

	public function setYearlyRevenue(?QuantitativeValue $yearlyRevenue): void
	{
		$this->yearlyRevenue = $yearlyRevenue;
	}

	public function getYearlyRevenue(): ?QuantitativeValue
	{
		return $this->yearlyRevenue;
	}

	public function setNumberOfEmployees(?QuantitativeValue $numberOfEmployees): void
	{
		$this->numberOfEmployees = $numberOfEmployees;
	}

	public function getNumberOfEmployees(): ?QuantitativeValue
	{
		return $this->numberOfEmployees;
	}

	public function setYearsInOperation(?QuantitativeValue $yearsInOperation): void
	{
		$this->yearsInOperation = $yearsInOperation;
	}

	public function getYearsInOperation(): ?QuantitativeValue
	{
		return $this->yearsInOperation;
	}
}

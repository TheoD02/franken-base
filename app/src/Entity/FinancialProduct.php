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
 * A product provided to consumers and businesses by financial institutions such as banks, insurance companies, brokerage firms, consumer finance companies, and investment companies which comprise the financial services industry.
 *
 * @see https://schema.org/FinancialProduct
 */
#[ORM\MappedSuperclass]
abstract class FinancialProduct extends Service
{
	/**
	 * Description of fees, commissions, and other terms applied either to a class of financial product, or by a financial service organization.
	 *
	 * @see https://schema.org/feesAndCommissionsSpecification
	 */
	#[ORM\ManyToOne(targetEntity: 'App\Entity\URL')]
	#[ApiProperty(types: ['https://schema.org/feesAndCommissionsSpecification'])]
	#[Assert\Url]
	private ?string $feesAndCommissionsSpecification = null;

	/**
	 * The annual rate that is charged for borrowing (or made by investing), expressed as a single percentage number that represents the actual yearly cost of funds over the term of a loan. This includes any fees or additional costs associated with the transaction.
	 *
	 * @see https://schema.org/annualPercentageRate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/annualPercentageRate'])]
	private ?string $annualPercentageRate = null;

	/**
	 * The interest rate, charged or paid, applicable to the financial product. Note: This is different from the calculated annualPercentageRate.
	 *
	 * @see https://schema.org/interestRate
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
	#[ApiProperty(types: ['https://schema.org/interestRate'])]
	private ?string $interestRate = null;

	public function setFeesAndCommissionsSpecification(?string $feesAndCommissionsSpecification): void
	{
		$this->feesAndCommissionsSpecification = $feesAndCommissionsSpecification;
	}

	public function getFeesAndCommissionsSpecification(): ?string
	{
		return $this->feesAndCommissionsSpecification;
	}

	public function setAnnualPercentageRate(?string $annualPercentageRate): void
	{
		$this->annualPercentageRate = $annualPercentageRate;
	}

	public function getAnnualPercentageRate(): ?string
	{
		return $this->annualPercentageRate;
	}

	public function setInterestRate(?string $interestRate): void
	{
		$this->interestRate = $interestRate;
	}

	public function getInterestRate(): ?string
	{
		return $this->interestRate;
	}
}

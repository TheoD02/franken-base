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
 * A product or service offered by a bank whereby one may deposit, withdraw or transfer money and in some cases be paid interest.
 *
 * @see https://schema.org/BankAccount
 */
#[ORM\MappedSuperclass]
abstract class BankAccount extends FinancialProduct
{
	/**
	 * An overdraft is an extension of credit from a lending institution when an account reaches zero. An overdraft allows the individual to continue withdrawing money even if the account has no funds in it. Basically the bank allows people to borrow a set amount of money.
	 *
	 * @see https://schema.org/accountOverdraftLimit
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/accountOverdraftLimit'])]
	#[Assert\NotNull]
	private MonetaryAmount $accountOverdraftLimit;

	/**
	 * The type of a bank account.
	 *
	 * @see https://schema.org/bankAccountType
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
	#[ApiProperty(types: ['https://schema.org/bankAccountType'])]
	private ?string $bankAccountType = null;

	/**
	 * A minimum amount that has to be paid in every month.
	 *
	 * @see https://schema.org/accountMinimumInflow
	 */
	#[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
	#[ORM\JoinColumn(nullable: false)]
	#[ApiProperty(types: ['https://schema.org/accountMinimumInflow'])]
	#[Assert\NotNull]
	private MonetaryAmount $accountMinimumInflow;

	public function setAccountOverdraftLimit(MonetaryAmount $accountOverdraftLimit): void
	{
		$this->accountOverdraftLimit = $accountOverdraftLimit;
	}

	public function getAccountOverdraftLimit(): MonetaryAmount
	{
		return $this->accountOverdraftLimit;
	}

	public function setBankAccountType(?string $bankAccountType): void
	{
		$this->bankAccountType = $bankAccountType;
	}

	public function getBankAccountType(): ?string
	{
		return $this->bankAccountType;
	}

	public function setAccountMinimumInflow(MonetaryAmount $accountMinimumInflow): void
	{
		$this->accountMinimumInflow = $accountMinimumInflow;
	}

	public function getAccountMinimumInflow(): MonetaryAmount
	{
		return $this->accountMinimumInflow;
	}
}

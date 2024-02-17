<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A payment method using a credit, debit, store or other card to associate the payment with an account.
 *
 * @see https://schema.org/PaymentCard
 */
#[ORM\MappedSuperclass]
abstract class PaymentCard extends FinancialProduct
{
    /**
     * A secure method for consumers to purchase products or services via debit, credit or smartcards by using RFID or NFC technology.
     *
     * @see https://schema.org/contactlessPayment
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/contactlessPayment'])]
    private ?bool $contactlessPayment = null;

    /**
     * The minimum payment is the lowest amount of money that one is required to pay on a credit card statement each month.
     *
     * @see https://schema.org/monthlyMinimumRepaymentAmount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/monthlyMinimumRepaymentAmount'])]
    private ?MonetaryAmount $monthlyMinimumRepaymentAmount = null;

    /**
     * A floor limit is the amount of money above which credit card transactions must be authorized.
     *
     * @see https://schema.org/floorLimit
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/floorLimit'])]
    #[Assert\NotNull]
    private MonetaryAmount $floorLimit;

    /**
     * A cardholder benefit that pays the cardholder a small percentage of their net expenditures.
     *
     * @see https://schema.org/cashBack
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/cashBack'])]
    private ?string $cashBack = null;

    public function setContactlessPayment(?bool $contactlessPayment): void
    {
        $this->contactlessPayment = $contactlessPayment;
    }

    public function getContactlessPayment(): ?bool
    {
        return $this->contactlessPayment;
    }

    public function setMonthlyMinimumRepaymentAmount(?MonetaryAmount $monthlyMinimumRepaymentAmount): void
    {
        $this->monthlyMinimumRepaymentAmount = $monthlyMinimumRepaymentAmount;
    }

    public function getMonthlyMinimumRepaymentAmount(): ?MonetaryAmount
    {
        return $this->monthlyMinimumRepaymentAmount;
    }

    public function setFloorLimit(MonetaryAmount $floorLimit): void
    {
        $this->floorLimit = $floorLimit;
    }

    public function getFloorLimit(): MonetaryAmount
    {
        return $this->floorLimit;
    }

    public function setCashBack(?string $cashBack): void
    {
        $this->cashBack = $cashBack;
    }

    public function getCashBack(): ?string
    {
        return $this->cashBack;
    }
}

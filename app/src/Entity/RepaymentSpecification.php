<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A structured value representing repayment.
 *
 * @see https://schema.org/RepaymentSpecification
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/RepaymentSpecification'])]
class RepaymentSpecification extends StructuredValue
{
    /**
     * The amount to be paid as a penalty in the event of early payment of the loan.
     *
     * @see https://schema.org/earlyPrepaymentPenalty
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/earlyPrepaymentPenalty'])]
    private ?MonetaryAmount $earlyPrepaymentPenalty = null;

    /**
     * Frequency of payments due, i.e. number of months between payments. This is defined as a frequency, i.e. the reciprocal of a period of time.
     *
     * @see https://schema.org/loanPaymentFrequency
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/loanPaymentFrequency'])]
    private ?string $loanPaymentFrequency = null;

    /**
     * The number of payments contractually required at origination to repay the loan. For monthly paying loans this is the number of months from the contractual first payment date to the maturity date.
     *
     * @see https://schema.org/numberOfLoanPayments
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Number')]
    #[ApiProperty(types: ['https://schema.org/numberOfLoanPayments'])]
    private ?string $numberOfLoanPayments = null;

    /**
     * a type of payment made in cash during the onset of the purchase of an expensive good/service. The payment typically represents only a percentage of the full purchase price.
     *
     * @see https://schema.org/downPayment
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/downPayment'])]
    #[Assert\NotNull]
    private MonetaryAmount $downPayment;

    /**
     * The amount of money to pay in a single payment.
     *
     * @see https://schema.org/loanPaymentAmount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/loanPaymentAmount'])]
    private ?MonetaryAmount $loanPaymentAmount = null;

    public function setEarlyPrepaymentPenalty(?MonetaryAmount $earlyPrepaymentPenalty): void
    {
        $this->earlyPrepaymentPenalty = $earlyPrepaymentPenalty;
    }

    public function getEarlyPrepaymentPenalty(): ?MonetaryAmount
    {
        return $this->earlyPrepaymentPenalty;
    }

    public function setLoanPaymentFrequency(?string $loanPaymentFrequency): void
    {
        $this->loanPaymentFrequency = $loanPaymentFrequency;
    }

    public function getLoanPaymentFrequency(): ?string
    {
        return $this->loanPaymentFrequency;
    }

    public function setNumberOfLoanPayments(?string $numberOfLoanPayments): void
    {
        $this->numberOfLoanPayments = $numberOfLoanPayments;
    }

    public function getNumberOfLoanPayments(): ?string
    {
        return $this->numberOfLoanPayments;
    }

    public function setDownPayment(MonetaryAmount $downPayment): void
    {
        $this->downPayment = $downPayment;
    }

    public function getDownPayment(): MonetaryAmount
    {
        return $this->downPayment;
    }

    public function setLoanPaymentAmount(?MonetaryAmount $loanPaymentAmount): void
    {
        $this->loanPaymentAmount = $loanPaymentAmount;
    }

    public function getLoanPaymentAmount(): ?MonetaryAmount
    {
        return $this->loanPaymentAmount;
    }
}

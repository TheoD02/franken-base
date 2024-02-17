<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A financial product for the loaning of an amount of money, or line of credit, under agreed terms and charges.
 *
 * @see https://schema.org/LoanOrCredit
 */
#[ORM\Entity]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr')]
#[ORM\DiscriminatorMap(['loanOrCredit' => LoanOrCredit::class, 'mortgageLoan' => MortgageLoan::class])]
class LoanOrCredit extends FinancialProduct
{
    /**
     * The period of time after any due date that the borrower has to fulfil its obligations before a default (failure to pay) is deemed to have occurred.
     *
     * @see https://schema.org/gracePeriod
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Duration')]
    #[ApiProperty(types: ['https://schema.org/gracePeriod'])]
    private ?Duration $gracePeriod = null;

    /**
     * A form of paying back money previously borrowed from a lender. Repayment usually takes the form of periodic payments that normally include part principal plus interest in each payment.
     *
     * @see https://schema.org/loanRepaymentForm
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\RepaymentSpecification')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/loanRepaymentForm'])]
    #[Assert\NotNull]
    private RepaymentSpecification $loanRepaymentForm;

    /**
     * The type of a loan or credit.
     *
     * @see https://schema.org/loanType
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\URL')]
    #[ApiProperty(types: ['https://schema.org/loanType'])]
    #[Assert\Url]
    private ?string $loanType = null;

    /**
     * The only way you get the money back in the event of default is the security. Recourse is where you still have the opportunity to go back to the borrower for the rest of the money.
     *
     * @see https://schema.org/recourseLoan
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/recourseLoan'])]
    private ?bool $recourseLoan = null;

    /**
     * The amount of money.
     *
     * @see https://schema.org/amount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/amount'])]
    private ?MonetaryAmount $amount = null;

    /**
     * Assets required to secure loan or credit repayments. It may take form of third party pledge, goods, financial instruments (cash, securities, etc.).
     *
     * @see https://schema.org/requiredCollateral
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/requiredCollateral'])]
    private ?string $requiredCollateral = null;

    /**
     * The currency in which the monetary amount is expressed.\\n\\nUse standard formats: \[ISO 4217 currency format\](http://en.wikipedia.org/wiki/ISO\_4217), e.g. "USD"; \[Ticker symbol\](https://en.wikipedia.org/wiki/List\_of\_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for \[Local Exchange Trading Systems\](https://en.wikipedia.org/wiki/Local\_exchange\_trading\_system) (LETS) and other currency types, e.g. "Ithaca HOUR".
     *
     * @see https://schema.org/currency
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\Text')]
    #[ApiProperty(types: ['https://schema.org/currency'])]
    private ?string $currency = null;

    /**
     * Whether the terms for payment of interest can be renegotiated during the life of the loan.
     *
     * @see https://schema.org/renegotiableLoan
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/renegotiableLoan'])]
    private ?bool $renegotiableLoan = null;

    /**
     * The duration of the loan or credit agreement.
     *
     * @see https://schema.org/loanTerm
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\QuantitativeValue')]
    #[ApiProperty(types: ['https://schema.org/loanTerm'])]
    private ?QuantitativeValue $loanTerm = null;

    public function setGracePeriod(?Duration $gracePeriod): void
    {
        $this->gracePeriod = $gracePeriod;
    }

    public function getGracePeriod(): ?Duration
    {
        return $this->gracePeriod;
    }

    public function setLoanRepaymentForm(RepaymentSpecification $loanRepaymentForm): void
    {
        $this->loanRepaymentForm = $loanRepaymentForm;
    }

    public function getLoanRepaymentForm(): RepaymentSpecification
    {
        return $this->loanRepaymentForm;
    }

    public function setLoanType(?string $loanType): void
    {
        $this->loanType = $loanType;
    }

    public function getLoanType(): ?string
    {
        return $this->loanType;
    }

    public function setRecourseLoan(?bool $recourseLoan): void
    {
        $this->recourseLoan = $recourseLoan;
    }

    public function getRecourseLoan(): ?bool
    {
        return $this->recourseLoan;
    }

    public function setAmount(?MonetaryAmount $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): ?MonetaryAmount
    {
        return $this->amount;
    }

    public function setRequiredCollateral(?string $requiredCollateral): void
    {
        $this->requiredCollateral = $requiredCollateral;
    }

    public function getRequiredCollateral(): ?string
    {
        return $this->requiredCollateral;
    }

    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setRenegotiableLoan(?bool $renegotiableLoan): void
    {
        $this->renegotiableLoan = $renegotiableLoan;
    }

    public function getRenegotiableLoan(): ?bool
    {
        return $this->renegotiableLoan;
    }

    public function setLoanTerm(?QuantitativeValue $loanTerm): void
    {
        $this->loanTerm = $loanTerm;
    }

    public function getLoanTerm(): ?QuantitativeValue
    {
        return $this->loanTerm;
    }
}

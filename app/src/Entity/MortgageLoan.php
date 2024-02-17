<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A loan in which property or real estate is used as collateral. (A loan securitized against some real estate.).
 *
 * @see https://schema.org/MortgageLoan
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MortgageLoan'])]
class MortgageLoan extends LoanOrCredit
{
    /**
     * Amount of mortgage mandate that can be converted into a proper mortgage at a later stage.
     *
     * @see https://schema.org/loanMortgageMandateAmount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/loanMortgageMandateAmount'])]
    #[Assert\NotNull]
    private MonetaryAmount $loanMortgageMandateAmount;

    /**
     * Whether borrower is a resident of the jurisdiction where the property is located.
     *
     * @see https://schema.org/domiciledMortgage
     */
    #[ORM\ManyToOne(targetEntity: 'App\Entity\Boolean')]
    #[ApiProperty(types: ['https://schema.org/domiciledMortgage'])]
    private ?bool $domiciledMortgage = null;

    public function setLoanMortgageMandateAmount(MonetaryAmount $loanMortgageMandateAmount): void
    {
        $this->loanMortgageMandateAmount = $loanMortgageMandateAmount;
    }

    public function getLoanMortgageMandateAmount(): MonetaryAmount
    {
        return $this->loanMortgageMandateAmount;
    }

    public function setDomiciledMortgage(?bool $domiciledMortgage): void
    {
        $this->domiciledMortgage = $domiciledMortgage;
    }

    public function getDomiciledMortgage(): ?bool
    {
        return $this->domiciledMortgage;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The act of transferring money from one place to another place. This may occur electronically or physically.
 *
 * @see https://schema.org/MoneyTransfer
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MoneyTransfer'])]
class MoneyTransfer extends TransferAction
{
    /**
     * A bank or bank’s branch, financial institution or international financial institution operating the beneficiary’s bank account or releasing funds for the beneficiary.
     *
     * @see https://schema.org/beneficiaryBank
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\BankOrCreditUnion')]
    #[ORM\JoinColumn(nullable: false)]
    #[ApiProperty(types: ['https://schema.org/beneficiaryBank'])]
    #[Assert\NotNull]
    private BankOrCreditUnion $beneficiaryBank;

    /**
     * The amount of money.
     *
     * @see https://schema.org/amount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/amount'])]
    private ?MonetaryAmount $amount = null;

    public function setBeneficiaryBank(BankOrCreditUnion $beneficiaryBank): void
    {
        $this->beneficiaryBank = $beneficiaryBank;
    }

    public function getBeneficiaryBank(): BankOrCreditUnion
    {
        return $this->beneficiaryBank;
    }

    public function setAmount(?MonetaryAmount $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): ?MonetaryAmount
    {
        return $this->amount;
    }
}

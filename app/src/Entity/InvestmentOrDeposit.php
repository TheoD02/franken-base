<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;

/**
 * A type of financial product that typically requires the client to transfer funds to a financial service in return for potential beneficial financial return.
 *
 * @see https://schema.org/InvestmentOrDeposit
 */
#[ORM\MappedSuperclass]
abstract class InvestmentOrDeposit extends FinancialProduct
{
    /**
     * The amount of money.
     *
     * @see https://schema.org/amount
     */
    #[ORM\OneToOne(targetEntity: 'App\Entity\MonetaryAmount')]
    #[ApiProperty(types: ['https://schema.org/amount'])]
    private ?MonetaryAmount $amount = null;

    public function setAmount(?MonetaryAmount $amount): void
    {
        $this->amount = $amount;
    }

    public function getAmount(): ?MonetaryAmount
    {
        return $this->amount;
    }
}

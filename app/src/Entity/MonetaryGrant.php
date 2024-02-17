<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A monetary grant.
 *
 * @see https://schema.org/MonetaryGrant
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MonetaryGrant'])]
class MonetaryGrant extends Grant
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

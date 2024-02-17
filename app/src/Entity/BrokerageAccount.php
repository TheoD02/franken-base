<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An account that allows an investor to deposit funds and place investment orders with a licensed broker or brokerage firm.
 *
 * @see https://schema.org/BrokerageAccount
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BrokerageAccount'])]
class BrokerageAccount extends InvestmentOrDeposit
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A type of Bank Account with a main purpose of depositing funds to gain interest or other benefits.
 *
 * @see https://schema.org/DepositAccount
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/DepositAccount'])]
class DepositAccount extends BankAccount
{
}

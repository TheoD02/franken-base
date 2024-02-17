<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A company or fund that gathers capital from a number of investors to create a pool of money that is then re-invested into stocks, bonds and other assets.
 *
 * @see https://schema.org/InvestmentFund
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/InvestmentFund'])]
class InvestmentFund extends InvestmentOrDeposit
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * ATM/cash machine.
 *
 * @see https://schema.org/AutomatedTeller
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AutomatedTeller'])]
class AutomatedTeller extends FinancialService
{
}

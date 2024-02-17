<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An Insurance agency.
 *
 * @see https://schema.org/InsuranceAgency
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/InsuranceAgency'])]
class InsuranceAgency extends FinancialService
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Accountancy business.\\n\\nAs a \[\[LocalBusiness\]\] it can be described as a \[\[provider\]\] of one or more \[\[Service\]\]\\(s).
 *
 * @see https://schema.org/AccountingService
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AccountingService'])]
class AccountingService extends FinancialService
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Service to transfer funds from a person or organization to a beneficiary person or organization.
 *
 * @see https://schema.org/PaymentService
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PaymentService'])]
class PaymentService extends FinancialProduct
{
}

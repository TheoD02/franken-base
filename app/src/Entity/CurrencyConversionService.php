<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A service to convert funds from one currency to another currency.
 *
 * @see https://schema.org/CurrencyConversionService
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CurrencyConversionService'])]
class CurrencyConversionService extends FinancialProduct
{
}

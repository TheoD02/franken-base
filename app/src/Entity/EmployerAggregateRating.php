<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An aggregate rating of an Organization related to its role as an employer.
 *
 * @see https://schema.org/EmployerAggregateRating
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/EmployerAggregateRating'])]
class EmployerAggregateRating extends AggregateRating
{
}

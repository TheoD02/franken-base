<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Childcare center.
 *
 * @see https://schema.org/ChildCare
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ChildCare'])]
class ChildCare extends LocalBusiness
{
}

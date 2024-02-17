<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An car dealership.
 *
 * @see https://schema.org/AutoDealer
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AutoDealer'])]
class AutoDealer extends AutomotiveBusiness
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A country.
 *
 * @see https://schema.org/Country
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Country'])]
class Country extends AdministrativeArea
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A city or town.
 *
 * @see https://schema.org/City
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/City'])]
class City extends AdministrativeArea
{
}

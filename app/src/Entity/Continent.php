<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * One of the continents (for example, Europe or Africa).
 *
 * @see https://schema.org/Continent
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Continent'])]
class Continent extends Landform
{
}

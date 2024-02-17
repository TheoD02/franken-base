<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A distillery.
 *
 * @see https://schema.org/Distillery
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Distillery'])]
class Distillery extends FoodEstablishment
{
}

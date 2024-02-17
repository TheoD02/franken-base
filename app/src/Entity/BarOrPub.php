<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A bar or pub.
 *
 * @see https://schema.org/BarOrPub
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BarOrPub'])]
class BarOrPub extends FoodEstablishment
{
}

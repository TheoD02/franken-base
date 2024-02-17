<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Properties that take Mass as values are of the form '&lt;Number&gt; &lt;Mass unit of measure&gt;'. E.g., '7 kg'.
 *
 * @see https://schema.org/Mass
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Mass'])]
class Mass extends Quantity
{
}

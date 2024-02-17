<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Properties that take Distances as values are of the form '&lt;Number&gt; &lt;Length unit of measure&gt;'. E.g., '7 ft'.
 *
 * @see https://schema.org/Distance
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Distance'])]
class Distance extends Quantity
{
}

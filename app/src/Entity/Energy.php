<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Properties that take Energy as values are of the form '&lt;Number&gt; &lt;Energy unit of measure&gt;'.
 *
 * @see https://schema.org/Energy
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Energy'])]
class Energy extends Quantity
{
}

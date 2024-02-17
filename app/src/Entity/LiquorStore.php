<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A shop that sells alcoholic drinks such as wine, beer, whisky and other spirits.
 *
 * @see https://schema.org/LiquorStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/LiquorStore'])]
class LiquorStore extends Store
{
}

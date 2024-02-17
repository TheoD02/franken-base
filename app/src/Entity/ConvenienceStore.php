<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A convenience store.
 *
 * @see https://schema.org/ConvenienceStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/ConvenienceStore'])]
class ConvenienceStore extends Store
{
}

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A movie rental store.
 *
 * @see https://schema.org/MovieRentalStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MovieRentalStore'])]
class MovieRentalStore extends Store
{
}

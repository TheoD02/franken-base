<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A bookstore.
 *
 * @see https://schema.org/BookStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BookStore'])]
class BookStore extends Store
{
}

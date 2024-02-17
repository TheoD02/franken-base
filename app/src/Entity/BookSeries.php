<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A series of books. Included books can be indicated with the hasPart property.
 *
 * @see https://schema.org/BookSeries
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/BookSeries'])]
class BookSeries extends CreativeWorkSeries
{
}

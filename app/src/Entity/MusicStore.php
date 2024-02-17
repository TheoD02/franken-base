<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A music store.
 *
 * @see https://schema.org/MusicStore
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/MusicStore'])]
class MusicStore extends Store
{
}

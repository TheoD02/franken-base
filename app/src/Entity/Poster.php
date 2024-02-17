<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A large, usually printed placard, bill, or announcement, often illustrated, that is posted to advertise or publicize something.
 *
 * @see https://schema.org/Poster
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Poster'])]
class Poster extends CreativeWork
{
}

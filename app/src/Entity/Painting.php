<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A painting.
 *
 * @see https://schema.org/Painting
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Painting'])]
class Painting extends CreativeWork
{
}

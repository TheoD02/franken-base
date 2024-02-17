<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Printed music, as opposed to performed or recorded music.
 *
 * @see https://schema.org/SheetMusic
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SheetMusic'])]
class SheetMusic extends CreativeWork
{
}

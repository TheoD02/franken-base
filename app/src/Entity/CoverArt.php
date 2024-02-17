<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The artwork on the outer surface of a CreativeWork.
 *
 * @see https://schema.org/CoverArt
 */
#[ORM\MappedSuperclass]
abstract class CoverArt extends VisualArtwork
{
}

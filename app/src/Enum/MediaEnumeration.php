<?php

namespace App\Enum;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use MyCLabs\Enum\Enum;

/**
 * MediaEnumeration enumerations are lists of codes, labels etc. useful for describing media objects. They may be reflections of externally developed lists, or created at schema.org, or a combination.
 *
 * @see https://schema.org/MediaEnumeration
 */
class MediaEnumeration extends Enum
{
}

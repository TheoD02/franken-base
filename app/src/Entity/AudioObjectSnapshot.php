<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A specific and exact (byte-for-byte) version of an \[\[AudioObject\]\]. Two byte-for-byte identical files, for the purposes of this type, considered identical. If they have different embedded metadata the files will differ. Different external facts about the files, e.g. creator or dateCreated that aren't represented in their actual content, do not affect this notion of identity.
 *
 * @see https://schema.org/AudioObjectSnapshot
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/AudioObjectSnapshot'])]
class AudioObjectSnapshot extends AudioObject
{
}

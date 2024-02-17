<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A play is a form of literature, usually consisting of dialogue between characters, intended for theatrical performance rather than just reading. Note: A performance of a Play would be a \[\[TheaterEvent\]\] or \[\[BroadcastEvent\]\] - the \*Play\* being the \[\[workPerformed\]\].
 *
 * @see https://schema.org/Play
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Play'])]
class Play extends CreativeWork
{
}

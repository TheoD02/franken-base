<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A file containing a note, primarily for the author.
 *
 * @see https://schema.org/NoteDigitalDocument
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/NoteDigitalDocument'])]
class NoteDigitalDocument extends DigitalDocument
{
}

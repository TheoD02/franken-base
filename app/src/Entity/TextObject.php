<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A text file. The text can be unformatted or contain markup, html, etc.
 *
 * @see https://schema.org/TextObject
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TextObject'])]
class TextObject extends MediaObject
{
}

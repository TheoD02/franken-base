<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A file composed primarily of text.
 *
 * @see https://schema.org/TextDigitalDocument
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/TextDigitalDocument'])]
class TextDigitalDocument extends DigitalDocument
{
}

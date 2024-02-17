<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A file containing slides or used for a presentation.
 *
 * @see https://schema.org/PresentationDigitalDocument
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PresentationDigitalDocument'])]
class PresentationDigitalDocument extends DigitalDocument
{
}

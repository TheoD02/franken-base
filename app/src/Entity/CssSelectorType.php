<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Text representing a CSS selector.
 *
 * @see https://schema.org/CssSelectorType
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/CssSelectorType'])]
class CssSelectorType extends Text
{
}

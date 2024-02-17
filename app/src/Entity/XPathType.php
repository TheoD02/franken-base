<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Text representing an XPath (typically but not necessarily version 1.0).
 *
 * @see https://schema.org/XPathType
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/XPathType'])]
class XPathType extends Text
{
}

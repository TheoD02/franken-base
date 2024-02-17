<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The header section of the page.
 *
 * @see https://schema.org/WPHeader
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WPHeader'])]
class WPHeader extends WebPageElement
{
}

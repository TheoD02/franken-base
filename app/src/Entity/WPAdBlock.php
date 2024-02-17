<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * An advertising section of the page.
 *
 * @see https://schema.org/WPAdBlock
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WPAdBlock'])]
class WPAdBlock extends WebPageElement
{
}

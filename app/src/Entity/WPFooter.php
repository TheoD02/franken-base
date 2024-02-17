<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * The footer section of the page.
 *
 * @see https://schema.org/WPFooter
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WPFooter'])]
class WPFooter extends WebPageElement
{
}

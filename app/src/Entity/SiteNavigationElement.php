<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A navigation element of the page.
 *
 * @see https://schema.org/SiteNavigationElement
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/SiteNavigationElement'])]
class SiteNavigationElement extends WebPageElement
{
}

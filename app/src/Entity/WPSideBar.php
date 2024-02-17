<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A sidebar section of the page.
 *
 * @see https://schema.org/WPSideBar
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/WPSideBar'])]
class WPSideBar extends WebPageElement
{
}

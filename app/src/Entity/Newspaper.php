<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A publication containing information about varied topics that are pertinent to general information, a geographic area, or a specific subject matter (i.e. business, culture, education). Often published daily.
 *
 * @see https://schema.org/Newspaper
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/Newspaper'])]
class Newspaper extends Periodical
{
}

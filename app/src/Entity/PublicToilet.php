<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * A public toilet is a room or small building containing one or more toilets (and possibly also urinals) which is available for use by the general public, or by customers or employees of certain businesses.
 *
 * @see https://schema.org/PublicToilet
 */
#[ORM\Entity]
#[ApiResource(types: ['https://schema.org/PublicToilet'])]
class PublicToilet extends CivicStructure
{
}
